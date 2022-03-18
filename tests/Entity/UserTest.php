<?php 

namespace App\Tests\Entity;

use App\Entity\User;
use App\Tests\AbstractTestCase;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Validator\ConstraintViolation;

class UserTest extends AbstractTestCase
{
    public function test_validity_entity_user()
    {
        $user = (new User())
            ->setEmail('user@user.user')
            ->setPassword('motdepasse');

        self::bootKernel();

        $errors = self::getContainer()->get('validator')->validate($user);
 
        $this->assertCount(0,$errors);
    } 

    public function test_invalidaty_entity_user_because_email_could_not_be_null()
    {
        $user = (new User())
        ->setPassword('motdepasse');

        self::bootKernel();

        $errors = self::getContainer()->get('validator')->validate($user);

        $this->assertCount(1,$errors);
    }

    public function test_invalidaty_entity_user_because_email_could_not_be_null2()
    {
        $user = (new User())
        ->setPassword(null);

        self::bootKernel();

        $errors = self::getContainer()->get('validator')->validate($user);
      
        $this->assertCount(2,$errors);
    }

    public function test_invalidaty_entity_user_because_password_could_not_be_null()
    {
        $user = (new User())
        ->setEmail('user@user.user');

        self::bootKernel();

        $errors = self::getContainer()->get('validator')->validate($user);
       
        
        $this->assertCount(1,$errors);
    }


    public function test_invalidaty_entity_user_because_email_could_not_be_blank()
    {
        //Je créé un User , en faisant expres de laisser l'email BLANK
        $user = (new User())
            ->setEmail('')
            ->setPassword('motdepasse');

        self::bootKernel();

        //Je passe dans mon Validator , le user précédemment créé.
        $errors = self::getContainer()->get('validator')->validate($user);

        //J'instancie un tableau pour récupérer tous les messages d'erreur
        $messages = $this->getErrorsMessages($errors);

        //Je créé une variable qui représente le message d'erreur que j'attends
        $errorMessage = 'Vous devez ajouter un email.';

        $this->assertCount(1,$errors);
        $this->assertContains($errorMessage, $messages);
    }

    public function test_invalidaty_entity_user_because_password_could_not_be_blank()
    {
        //Je créé un User , en faisant expres de laisser l'email BLANK
        $user = (new User())
            ->setEmail('user@user.user')
            ->setPassword('');

        self::bootKernel();

        //Je passe dans mon Validator , le user précédemment créé.
        $errors = self::getContainer()->get('validator')->validate($user);

        //J'instancie un tableau pour récupérer tous les messages d'erreur
        $messages = $this->getErrorsMessages($errors);

        //Je créé une variable qui représente le message d'erreur que j'attends
        $errorMessage = 'Vous devez ajouter un mot de passe.';

        $this->assertCount(1,$errors);
        $this->assertContains($errorMessage, $messages);
    }
}