<?php

use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase
{
    public function testSignupEmptyFields()
    {
        $_POST['signup-submit'] = true;
        $_POST['uid'] = '';
        $_POST['mail'] = '';
        $_POST['pwd'] = '';
        $_POST['pwd-repeat'] = '';

        ob_start();
        include 'signup.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Location: ../index.php?error=emptyfields', $output);
    }

    public function testSignupInvalidEmailUsername()
    {
        $_POST['signup-submit'] = true;
        $_POST['uid'] = 'user@name';
        $_POST['mail'] = 'invalidemail';
        $_POST['pwd'] = 'password';
        $_POST['pwd-repeat'] = 'password';

        ob_start();
        include 'signup.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Location: ../index.php?error=invalidemailusername', $output);
    }


}


