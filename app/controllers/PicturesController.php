<?php
/**
 * Created by PhpStorm.
 * User: fahmi
 * Date: 04.10.2020
 * Time: 13:56
 */

namespace App\Controllers;


use App\Core\Application;

class PicturesController
{

    public function index()
    {
        $items = Application::get('database')->paginate('pictures', 0, 10);
        foreach ($items as $key => $item) {
            $photos = json_decode($item['photos']);
            $items[$key]['photos'] = array_map(static function ($photo) {
                return '/upload/images/' . $photo;
            }, $photos);
        }

        return view('index', compact('items'));
    }

    public function showMore()
    {
        $items = Application::get('database')->paginate('pictures', $_POST['start'], $_POST['limit']);

        echo json_encode($items);
    }

    public function showAddForm()
    {
        return view('add_form');
    }

    public function store()
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];

        $errors = [];
        if (!$name) {
            $errors['name'] = 'Поле Имя не заполнено';
        }
        if (!$phone) {
            $errors['phone'] = 'Поле Телефон не заполнено';
        }
        if (!$age) {
            $errors['age'] = 'Поле Дата рождения не заполнено';
        }
        if (!$this->validateAge($age, 18)) {
            $errors['age'] = 'Вы не достигли 18 лет';
        }

        if (!empty($errors)) {
            echo json_encode(['errors' => $errors]);
            return;
        }

        $images = [];
        $countFiles = is_array($_FILES['photos']['name']) ? count($_FILES['photos']['name']) : false;
        if ($countFiles) {
            for ($i = 0; $i < $countFiles; $i++) {
                $imageName = time() . "_" . $_FILES['photos']['name'][$i];
                $ext = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
                $maxFileSize = 1024 * 1024 * 1;
                $valid_extensions = ['jpeg', 'jpg', 'png'];
                if (in_array($ext, $valid_extensions) && $_FILES['photos']['size'][$i] <= $maxFileSize) {
                    if (move_uploaded_file($_FILES['photos']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/{$imageName}")) {
                        $images[] = $imageName;
                    }
                }
            }

        }

        $data = [
            'name' => $name,
            'phone' => cleanNumbers($phone),
            'age' => $age,
            'photos' => json_encode($images)
        ];

        if ($row = Application::get('database')->insert('pictures', $data)) {
            echo json_encode(['success' => $row]);
        }

    }

    protected function validateAge($age, $min)
    {
        $birthYear = (new \DateTime($age))->format('Y');
        $currentYear = Date('Y');
        if ($currentYear - $birthYear < $min) {
            return false;
        }
        return $age;
    }


}
