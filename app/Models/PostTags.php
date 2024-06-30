<?php

namespace App\Models;

use App\Application\Database\Model;

class PostTags extends Model
{
    protected string $table = "post_tags";
    protected array $fields = ["post_id", "tag_id"];
    protected ?int $tag_id;
    protected ?int $post_id;

    public function setTagId(int $tag_id): void
    {
        $this->tag_id = $tag_id;
    }

    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }

    public function getTagId(): int
    {
        return $this->tag_id;
    }

    public function getPostId(): int
    {
        return $this->post_id;
    }

    public function getTagTitle(): ?string
    {
        $title = (new Tag())->find("id", $this->tag_id);
        return $title->getTitle();
    }

    public function searchPost(string $query): array
    {
        $byTagResults = [];
        $byTag = (new Tag())->search($query, 'title');
        foreach ($byTag as $tag) {
            $postTags = (new PostTags())->find("tag_id", $tag->id(), true);

            foreach ($postTags as $postTag) {
                $post = (new Post())->find('id', $postTag->getPostId());
                if ($post) {
                    $byTagResults[] = $post;
                }
            }
        }
        return $byTagResults;
    }

    public function getPopularTags($limit = 5): array
    {
        $query = "SELECT tag_id, COUNT(*) as tag_count
                  FROM {$this->table}
                  GROUP BY tag_id
                  ORDER BY tag_count DESC
                  LIMIT :limit";

        $stmt = self::connect()->prepare($query);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();

        $tags = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $result = [];
        foreach ($tags as $tag) {
            $tagModel = (new Tag())->find('id', $tag['tag_id']);
            $latestPost = $this->getLatestPostByTag($tag['tag_id']);
            $result[] = [
                'tag' => $tagModel,
                'latest_post' => $latestPost
            ];
        }

        return $result;
    }

    public function getLatestPostByTag(int $tagId)
    {
        $query = "SELECT p.* 
              FROM posts p
              JOIN post_tags pt ON p.id = pt.post_id
              WHERE pt.tag_id = :tag_id
              ORDER BY p.id DESC
              LIMIT 1";

        $stmt = self::connect()->prepare($query);
        $stmt->bindValue(':tag_id', $tagId, \PDO::PARAM_INT);
        $stmt->execute();

        $post = $stmt->fetch(\PDO::FETCH_ASSOC);

        $postModel = (new Post())->find('id', $post['id']);
        return $postModel;
    }
}
