<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/logic.php');
//Шапка
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/header.php');

//redirectNonAuthUsers();

if (array_key_exists('getList', $_GET)) {
    $getList = $_GET['getList'];
} else {
    $getList = 'Список охранников';
}

if ($getList == 'Список охранников') {
    $addErrors = GuardActions::addGuard();
    $changeErrors = GuardActions::changeGuard();
    $deleteErrors = GuardActions::deleteGuard();
} elseif ($getList == 'Список постов') {
    $addErrors = SecurityPostActions::addPost();
    $changeErrors = SecurityPostActions::changePost();
    $deleteErrors = SecurityPostActions::deletePost();
}
//Вывод ошибок, если они есть
(count($addErrors)) ? showAlertWindow($addErrors) : null;
(count($changeErrors)) ? showAlertWindow($changeErrors) : null;
(count($deleteErrors)) ? showAlertWindow($deleteErrors) : null;

$dataArray = GuardActions::getGuards();
if (array_key_exists('filtrQueueFio', $_GET)) {
    $filtrFio = htmlspecialchars($_GET['filtrQueueFio']);
} else {
    $filtrFio = '';
}
if (array_key_exists('filtrQueueDesc', $_GET)) {
    $filtrDesc = htmlspecialchars($_GET['filtrQueueDesc']);
} else {
    $filtrDesc = '';
}
if (array_key_exists('filtrQueueName', $_GET)) {
    $filtrName = htmlspecialchars($_GET['filtrQueueName']);
} else {
    $filtrName = '';
}
if (array_key_exists('filtrQueueDoB1', $_GET)) {
    $filtrDoB1 = htmlspecialchars($_GET['filtrQueueDoB1']);
}
if (array_key_exists('filtrQueueDoB2', $_GET)) {
    $filtrDoB2 = htmlspecialchars($_GET['filtrQueueDoB2']);
}

$guardPosts = SecurityPostTable::getPosts();
?>
<!--Контейнер с данными-->
<div class="container text-center mt-3">
    <form method="get">
        <div class="col" style="max-width: 400px;">
            <input class="form-control" type="text" placeholder="Фильтр по имени" id="filtrQueueFio"
                name="filtrQueueFio" value="<?php echo $filtrFio; ?>">
            <input class="form-control" type="text" placeholder="Фильтр по Описанию" id="filtrQueueDesc"
                name="filtrQueueDesc" value="<?php echo $filtrDesc; ?>">
            <select class="form-select" id="filtrQueueName" name="filtrQueueName" value="<?php echo $filtrName ?>">
                <option value="">Выберите из списка</option>
                <?php foreach ($guardPosts as $post): ?>
                    <option value="<?php echo htmlspecialchars($post['name']) ?>" <?php echo ($filtrName === $post['name']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($post['name']) ?></option>
                <?php endforeach ?>
            </select>
            <p>Фильтр даты рождения от</p>
            <input class="form-control" type="date" placeholder="Фильтр по дню рождения от" id="filtrQueueDoB1"
                name="filtrQueueDoB1" value="<?php echo $filtrDoB1; ?>">
            <p>Фильтр даты рождения до</p>
            <input class="form-control" type="date" placeholder="Фильтр по дню рождения до" id="filtrQueueDoB2"
                name="filtrQueueDoB2" value="<?php echo $filtrDoB2; ?>">
        </div>
        <div class="col" style="max-width: 450px; margin-top: 20px;">
            <input class="form-control" type="submit" class="button" name="filtr" style="margin-bottom: 10px;"
                value="Применить фильтр">
            <input class="form-control" type="submit" class="button" name="filtr" value="Сбросить фильтр">
        </div>
    </form>
    <form method="get">
        <div class="col" style="max-width: 450px; margin-top: 20px;">
            <input class="form-control" type="submit" class="button" name="getList" style="margin-bottom: 10px;"
                value="Список постов">
            <input class="form-control" type="submit" class="button" name="getList" value="Список охранников">
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <?php if ($getList == 'Список охранников'): ?>
                    <th scope="col">Фото</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Пост</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Дата рождения</th>
                    <th scope="col">
                        <button style="margin-left: 30px;" class="btn btn-primary" type="button" id="addMenuShow">Добавить
                            охранника</button>
                    </th>
                <?php elseif ($getList == 'Список постов'): ?>
                    <th scope="col">Название поста</th>
                    <th scope="col">Местоположение</th>
                    <th scope="col">
                        <button style="margin-left: 30px;" class="btn btn-primary" type="button" id="addMenuShow">Добавить
                            пост охраны</button>
                    </th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php if ($getList == 'Список охранников'): ?>
                <?php foreach ($dataArray as $item): ?>
                    <tr>
                        <th scope="row">
                            <img style="max-width: 150px;" src="/Project/images/<?php echo $item['img_path'] ?>"
                                alt="LICO IMAGE" srcset="">
                            <div style="display: none;">
                                <?php echo $item['id'] ?>
                            </div>
                        </th>
                        <td>
                            <?php echo $item["fio"] ?>
                        </td>
                        <td>
                            <?php echo $item['name'] ?>
                        </td>
                        <td>
                            <?php echo $item['description'] ?>
                        </td>
                        <td>
                            <?php echo $item['date_of_birth'] ?>
                        </td>
                        <td>
                            <button class="btn btn-secondary rounded-pill px-3" type="button" onclick="showModalDialogChangeGuard(
                                    <?php echo ('\'' . $item['id'] . '\',\'' . $item['fio'] . '\',\'' . $item['name'] . '\',\'' . $item['description'] . '\',\'' . $item['date_of_birth'] . '\''); ?>
                                    );">
                                Изменить
                            </button>
                        </td>
                        <td>
                            <form method="post">
                                <input type="text" name="guardId" value="<?php echo $item['id'] ?>" style="display: none;">
                                <input type="text" name="action" value="deleteGuard" style="display: none;">
                                <button class="btn btn-danger rounded-pill px-3" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($guardPosts as $post): ?>
                    <tr>
                        <div style="display: none;">
                            <?php echo $post['id_post'] ?>
                        </div>
                        <td>
                            <?php echo htmlspecialchars($post['name']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($post['location']) ?>
                        </td>
                        <td>
                            <button class="btn btn-secondary rounded-pill px-3" type="button"
                                onclick="showModalDialogChangePost(<?php echo $post['id_post'] . ',\'' . $post['name'] . '\',\'' . $post['location'] . '\'' ?>);">Изменить</button>
                        </td>
                        <td>
                            <form method="post">
                                <input type="text" name="postId" value="<?php echo $post['id_post'] ?>" style="display: none;">
                                <input type="text" name="action" value="deletePost" style="display: none;">
                                <button class="btn btn-danger rounded-pill px-3" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>
<!-- Модальное окно создания-->
<div class="fixed-overlay" id="fixed-overlay-create" style="display: none;">
    <div class="modal-dialog" role="document" id="modal-dialog-create">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">
                    <?php if ($getList == 'Список охранников'): ?>
                        Добавить охранника
                    <?php else: ?>
                        Добавить пост охранны
                    <?php endif ?>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="closeModalDialogCreateBtn"></button>
            </div>
            <div class="modal-body p-5 pt-0">
                <form enctype="multipart/form-data" method="post">
                    <?php if ($getList == 'Список охранников'): ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="floatingInput" name="guardFio"
                                placeholder="name@example.com">
                            <label for="floatingInput">ФИО</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="Password"
                                name="guardDescription">
                            <label for="floatingInput">Описание</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="date" placeholder="Фильтр по дню рождения от" id="DoB"
                                name="guardDoB">
                            <label for="Dob">Дата рождения</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="filtrQueueName" name="guardPost">
                                <option value="">Выберите из списка</option>
                                <?php foreach ($guardPosts as $post): ?>
                                    <option value="<?php echo htmlspecialchars($post['name']) ?>"><?php echo htmlspecialchars($post['name']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <label for="">Пост охраны</label>
                        </div>
                        <div class="mb-3">
                            <label for="img">Фото охранника</label>
                            <input type="file" class="form-control form-control-sm" aria-label="Small file input example"
                                name="guardIMG" id="" accept="image/jpeg,image/png">
                        </div>
                        <input type="text" name="action" value="addGuard" style="display: none;">
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Добавить</button>
                    <?php else: ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="floatingInput" name="postName"
                                placeholder="name@example.com">
                            <label for="floatingInput">Название поста охраны</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="Password"
                                name="postLocation">
                            <label for="floatingInput">Местонахождение</label>
                        </div>
                        <input type="text" name="action" value="addPost" style="display: none;">
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Добавить</button>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Модальное окно изменения-->
<div class="fixed-overlay" id="fixed-overlay-change" style="display: none;">
    <div class="modal-dialog" role="document" id="modal-dialog-change">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">
                    <?php if ($getList == 'Список охранников'): ?>
                        Изменить данные охранника
                    <?php else: ?>
                        Изменить данные поста охраны
                    <?php endif ?>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="closeModalDialogChangeBtn"></button>
            </div>
            <div class="modal-body p-5 pt-0">
                <form enctype="multipart/form-data" class="" method="post">
                    <?php if ($getList == 'Список охранников'): ?>
                        <input type="text" style="display: none;" name="guardId" id="changeId">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="changeFio" name="guardFio"
                                placeholder="name@example.com">
                            <label for="floatingInput">ФИО</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="changeDesc" placeholder="Password"
                                name="guardDescription">
                            <label for="floatingInput">Описание</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="date" placeholder="Фильтр по дню рождения от" id="changeDoB"
                                name="guardDoB">
                            <label for="Dob">Дата рождения</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="changePostName" name="guardPost">
                                <option value="">Выберите из списка</option>
                                <?php foreach ($guardPosts as $post): ?>
                                    <option value="<?php echo htmlspecialchars($post['name']) ?>"><?php echo htmlspecialchars($post['name']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <label for="">Пост охраны</label>
                        </div>
                        <div class="mb-3">
                            <label for="img">Фото охранника</label>
                            <input type="file" class="form-control form-control-sm" aria-label="Small file input example"
                                name="guardIMG" id="" accept="image/jpeg,image/png">
                        </div>
                        <input type="text" name="action" value="changeGuard" style="display: none;">
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Изменить</button>
                    <?php else: ?>
                        <input type="text" style="display: none;" name="postId" id="changeId">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="changePostName" name="postName"
                                placeholder="">
                            <label for="floatingInput">Название поста охраны</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="changePostLocation" placeholder=""
                                name="postLocation">
                            <label for="floatingInput">Местонахождение</label>
                        </div>
                        <input type="text" name="action" value="changePost" style="display: none;">
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Изменить</button>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Подвал-->
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/footer.php') ?>