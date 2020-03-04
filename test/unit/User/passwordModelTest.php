<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_password/model_password.php';

class passwordModelTest extends TestCase
{
    public function testChangePassword()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModelePassword($dsn, $user, $password);

        $_SESSION['private_key'] = '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC2WWjAwPdYoa3A
q4UN4Lfn/q6JQwucZLL7YCGQWevHmY7QEjexBFfVu86URU1iXDjaFGsic3ZtSm7h
0deU4FaxOMYcuCpp3oYQCqTQ2Ukg1le1lCsayjAls0B5RhJsE145mCBtPEzPLFHH
rUJQ+SF/30OuexUaeBEaiD00lYdLWr+e/+RjQm2Nb3nMNBQKCD31435lyl68lp+x
WSpXNWebXttTm5RHJfkesTYjOv6/2JrpoIlQoQCGUyAtJNAzsLQHKyZlrmGFKBs+
7BzB02UH7GHQ2ekW0FXbQzNEmlXPGAT/aoi5CSsyyVhgTgcS5V3axELhYO74k/Rf
K3pC5/zNAgMBAAECggEAAYy+/CxnrcQqAuIyTkzjo0Ah4Z7FQX4Fm2dUwbJR869V
bGVLPeDokjN3bQEtyDE6dngH9RIAJqukR50N9QD3G6h83o+eJKo0f3xnrDK8kV/g
/PUWbLLdN+TPHni+/VYozdqCJAuIJ5ab11Ocpa2IYFrYa2o2YrQ0iQIxavn+XWCT
ZMeXWSwIJTgHrAvjVyuwydvVVDHSF4MkjFoH6xh8Kt1b56EzYg24zy71Ks1+A+hx
QaBEx2H9eSuQPqLQXoZ7GD/JvuvLFW3yG4xT+aOCt4r+CBBc6INn3VFMr5kYe+Wo
SZZFL2k6MqipoyBINR7ExZO1ui5E5juF94eypq4T7QKBgQDkEmvVqpBDPefJE0/1
ervc+OAtEV/6iamAPchAePVOmtdlDaEjek3ewYqVt4/s47+6NH0V/yg8D0LzcKEh
fl8JIjB9NBY2e4fo61rvOMS/jFPgVZMSw9JEpT56/XwJV2X6IpLGo5w1BAnDeIlc
5sKIGsV9deA64ZAeSgqKBUxxHwKBgQDMra1G5vD8PCVijePxCCkCDqbZ0dGrvonS
ArJXMiw2tzXCHQZib38Aq2QNdQRRGe76aftHWzrJcnNCPwPo7BS29+B3Ov+TuaQW
EEO5RUWis1dv/Z+Nw3ONbnl1OPiSylwC7+PQBLC0DULkg5yGmRLMZiad8bWFcHGX
F5Ss9vP4kwKBgQDRrSncTqnAV/pu/sVE/qgV9+xJIq8la0gcsTAYLdwAfxRFQCmD
r15Fy5M4H4E/HQbYDodtIJ6B0NoRatuIKmD+yaLgiHFfd2Q0u6NnSL6BB2bZWHMV
DliSaYSul7pf8Cy9sOlVm3bxupurTHakpTX04P/tXuBd4Z+YaSOVTle/qwKBgCUi
NVexunLorpesyngGVPpMkjTefj28eeCiIJz1O1RJ9PTcszXUqKQEdEiEvF3CaLsB
01bk1EuL+iFAsYLmofN4ET9QcuHoQj7GgKLyUGnuQ6TLzNC5bxNvwZVk2qQ3Fm5p
+1jYIP7pkQNIZXN9/g0bU1JAcgBdoB4bZxviSe0FAoGBAMe9XhBwh2iSKAMqzGW/
HV4NJxnHE0QCp/NgfPxdI4hqAu8G7zjFCtISV8wK92WY8DNogP+wyXakWB4/uD8k
OeBkdL5xxD3xUMpfUCw+8vc8vsyZuxP3F2+8oafKP7nRUyceJNCqg76Twmz0ZPDe
i38GFVbBH7hx9T+dO0C32tW1
-----END PRIVATE KEY-----
';
        $this->assertSame('Please enter the passwords', $model->changePassword());
        $_POST["oldPassword"] = "test";
        $this->assertSame('Please enter the passwords', $model->changePassword());
        $_POST["newPassword"] = "test";
        $this->assertSame('Please enter the passwords', $model->changePassword());
        $_POST["newPasswordRepeat"] = "test2";

        $_SESSION['pseudo'] = 'testidsession';
        $this->assertSame("Your old password isn't correct !", $model->changePassword());

        $_POST["oldPassword"] = "caca1234";
        $this->assertSame('The two passwords do not match !', $model->changePassword());

        $_POST["newPasswordRepeat"] = "test";
        $this->assertSame(NULL, $model->changePassword());
    }
}
?>
