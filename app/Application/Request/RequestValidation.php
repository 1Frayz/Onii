<?php

namespace App\Application\Request;

use App\Application\Alerts\Error;

trait RequestValidation
{
    private array $errors = [];

    protected function validate(array $data, array $rules): array|bool
    {
        foreach ($rules as $key => $rule) {
            foreach ($rule as $item) {
                switch ($item) {
                    case "required":
                        if (empty($data[$key])) {
                            $this->errors[$key][] = "Empty field";
                        }
                        break;
                    case "email":
                        if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
                            $this->errors[$key][] = "Wrong email format";
                        }
                        break;
                    case "numeric":
                        if (!is_numeric($data[$key])) {
                            $this->errors[$key][] = "Must be a numeric value";
                        }
                        break;
                    case "integer":
                        if (!filter_var($data[$key], FILTER_VALIDATE_INT)) {
                            $this->errors[$key][] = "Must be an integer";
                        }
                        break;
                    case "url":
                        if (!filter_var($data[$key], FILTER_VALIDATE_URL)) {
                            $this->errors[$key][] = "Invalid URL format";
                        }
                        break;
                    case "date":
                        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $data[$key])) {
                            $this->errors[$key][] = "Invalid date format (YYYY-MM-DD)";
                        } else {
                            $parts = explode('-', $data[$key]);
                            if (!checkdate($parts[1], $parts[2], $parts[0])) {
                                $this->errors[$key][] = "Invalid date";
                            }
                        }
                        break;
                    case "alpha":
                        if (!ctype_alpha($data[$key])) {
                            $this->errors[$key][] = "Must contain only alphabetic characters";
                        }
                        break;
                    case "password_confirm":
                        if ($data[$key] != $data["password_confirm"]) {
                            $this->errors[$key][] = "Passwords Do not match";
                        }
                        break;
                    case "image":
                        if (!isset($_FILES[$key]) || $_FILES[$key]['error'] !== UPLOAD_ERR_OK) {
                            $this->errors[$key][] = "Image upload error";
                        } else {
                            $fileInfo = getimagesize($_FILES[$key]['tmp_name']);
                            if ($fileInfo === false) {
                                $this->errors[$key][] = "Uploaded file is not a valid image";
                            } else {
                                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                if (!in_array($fileInfo['mime'], $allowedTypes)) {
                                    $this->errors[$key][] = "Only JPEG, PNG and GIF formats are allowed";
                                }
                                $maxFileSize = 24 * 1024 * 1024;
                                if ($_FILES[$key]['size'] > $maxFileSize) {
                                    $this->errors[$key][] = "Image size should not exceed 5MB";
                                }
                                $maxWidth = 10000;
                                $maxHeight = 10000;
                                if ($fileInfo[0] > $maxWidth || $fileInfo[1] > $maxHeight) {
                                    $this->errors[$key][] = "Image dimensions should not exceed 2000x2000 pixels";
                                }
                            }
                        }
                        break;
                }
            }
        }
        Error::store($this->errors);
        return $this->errors;
    }

    public function validationStatus(): bool
    {
        return !empty($this->errors);
    }

    public function validationStatusErrors(): array
    {
        return $this->errors;
    }
}
