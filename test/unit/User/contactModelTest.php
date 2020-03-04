 <?php
use PHPUnit\Framework\TestCase;
use PHPMailer\src\PHPMailer;
use PHPMailer\src\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

require_once 'public/include/model_gen.php';
require_once 'public/modules/module_contact/model_contact.php';


class contactModelTest extends TestCase
{

    public function testRegisterAdmin()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleContact($dsn, $user, $password);
        // no name given 
        $_POST = array();
        $this->assertSame("Please enter your name", $model->sendEmail());
        // no name given 
        $_POST['name'] = ''; 
        $this->assertSame("Please enter your name", $model->sendEmail());
        // noemail given 
        $_POST['name'] = 'test'; 
        $this->assertSame("Please enter your email", $model->sendEmail());
        $_POST['email'] = ''; 
        $this->assertSame("Please enter your email", $model->sendEmail());
        $_POST['email'] = 'test@test.fr'; 
        $this->assertSame("Your message is empty!", $model->sendEmail());
        $_POST['content'] = 'Wonderful message'; 
        $this->assertSame(NULL, $model->sendEmail());


    }
}
?>
