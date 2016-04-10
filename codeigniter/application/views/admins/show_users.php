<?php
// I don't like how this works. Will need to find a better system!!

if($users !== FALSE) {
    echo <<<HTML
    <div class="container">
    <div class="row">
    <br>
    <table border="1" class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
HTML;

    if(is_array($users) && count($users)) {
        foreach($users as $user) {
            echo <<<HTML
                <tr>
                    <td>{$user->getId()}</td>
                    <td>{$user->getFname()}</td>
                    <td>{$user->getLname()}</td>
                    <td>{$user->getUsername()}</td>
                </tr>
HTML;
        }
    } else {
        echo <<<HTML
            <tr>
                <td>{$users->getId()}</td>
                <td>{$users->getFname()}</td>
                <td>{$users->getLname()}</td>
                <td>{$users->getUsername()}</td>
            </tr>
HTML;
    }
    echo <<<HTML
        </tbody>
    </table>
    </div>
    </div>
HTML;
} else {
    echo <<<HTML
        <p>A user could not be found with the specified user ID
HTML;
}