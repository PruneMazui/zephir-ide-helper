namespace Utils;

use Exception;

/**
 * Sample class Greeting
 */
class Greeting
{
    /**
     * hogege
     */
    const CONSTANT_TEXT = "aaaaa";

    /**
     * @var string
     */
    protected static static_message = "hello world"  { get };

    /**
     * @var string
     */
    protected message = "hello world" { get, set, toString };

    /**
     * constructor
     *
     * @param string optional message
     */
    public function __construct(string message = null, string hoge = "", string fuga = "null", array piyo = [])
	{
        if message !== null {
            let this->message = message;
        }
    }

    /**
     * Output "hello zephir world" to STDOUT
     *
     * @return void
     */
    public static function say()
    {
        echo "hello world!";
    }

    public final deprecated function deprecatedFunction()
    {
        echo "old";
    }
}
