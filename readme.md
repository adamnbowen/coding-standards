# Fork CMS coding standards
## 1. General
### 1.1 Encoding
* Always save files as UTF-8. This ensures the most interoperability when working with different languages and editors.
* Do not save the [BOM](http://en.wikipedia.org/wiki/Byte_order_mark). PHP outputs it as-is, causing the HTTP response headers to be sent prematurely.

### 1.2 Line endings
* Use only Unix-style line endings (`\n`).
* End every line with said line ending. (The last line is not magical, so it ends in `\n` just like all other lines.)

### 1.3 Indenting and aligning
* Indent code using tabs. This allows everyone to use their preferred tab width.
* Align code spread across multiple lines using spaces. Never assume everyone uses four spaces per tab.

Example:

	<?php
  
	function getPosts(SpoonDatabase $db, $bla)
	{
		// this is indented with one tab
		$db->query(
			// this is indented with two tabs
			'SELECT *
			 -- the following lines are indented with two tabs and aligned with one space
			 FROM table
			 WHERE bla = ?
			 ORDER BY id',
			// this is indented with two tabs
			$bla
		);
	}

### 1.4 Opening/closing tags
* Always use the full `<?php` opening tag. Do not use the deprecated `<?` short tags. (This also avoids problems when mixing XML and PHP code.)
* Do not use closing tags. This avoids unexpected whitespace causing the HTTP response headers to be sent.

Example:

	<?php
	
	// my code goes here...
	
## 2. Strings
### 2.1 Literal strings
Literal strings should always be demarcaated with single quotes.

	$string = 'this is my string';

### 2.2 Variable substitution
We don't allow double quotes to demarcate strings containing variables unless it's improving readability
	
	// what you can do
	$string = 'Hello name is ' . $name;
	$string = 'Hi there ' . $name . ', How are you?';
	$string = "Hi $name, your id is $id\n";
	
	// what NOT to do
	$string = 'He likes \'fruit\', \'sports\' and \'television\'';
	$string = "Hi there, how are you";
	
### 2.3 Concatenating strings
	
	$string = $foo . $bar;
	$string = 'I like ' . $foo;
	$string = 'How about them ' . $fruit . "\n";
	$string = $filename . '.' . $extension;
	$string = 'I like peanuts' . "\n";
	
## 3. Arrays
### 3.1 Numerically indexed arrays
Don't use negative indices in your arrays. Numeric arrays should start from 0. One trailing space needs to be added after every comma delimiter.

	$array = array(37, 55, 'Peanuts', 'Boggle');

You may also declare an array on multiple lines if this improves readability. Make sure the lines are aligned properly.

	$myArray(
		1, 2, 3,
		'one', 'two', 'three',
		$one, $two, $three
	);

### 3.2 Associative arrays
The same rules apply as for numerically indexed arrays.

	$user = array(
		'name' => 'Davy Hellemans',
		'email' => 'davy@spoon-library.com'
	);

### 3.3 Multidimensional arrays

	$users = array(
		1 => array(
			'name' => 'Tijs Verkoyen',
			'email' => 'tijs@sumocoders.be'
		),
		2 => array(
			'name' => 'Matthias Mullie',
			'email' => 'matthias.mullie@netlash.com'
		)
	);

## 4. Classes
## 4.1 Declaring classes
The brace is written on the line underneath the class name. Every class must have a documentation block. Multiple classes in one file are not allowed.
***
@tijs - meerdere classes in 1 file is voor mij (davy) toegestaan, maar dan moet er een duidelijke regel zijn wanneer het wel kan en wanneer niet. Als we daar geen deftig antwoord op hebben, dan moeten we mssn 1 class per file afdwingen?
***

It's ok to place additional code in a class file (eg require_once statement). In such cases, one blank line must separate the statement from the other code. If you have multiple require_once statements, there's no need to place an empty line between those statements.

	/**
	 * This is the description of this class.
	 *
	 * @package backend
	 * @subpackage users
	 * @author Davy Hellemans <davy.hellemans@netlash.com>
	 * @since 2.6
	 */
	class BackendUsersAdd
	{
		// code, indented with 1 tab
	}
	
Classes that implement interfaces or extend other classes should always be on one line.

	class BackendUsersAdd extends BackendAction implements Backend, Users, Action
	{
	}
	

## 4.2 Class member variables
Member variables must be named according to Fork NG’s variable naming conventions. Any variables declared in a class must be listed alphabetically at the top of the class, above the declaration of any methods.

The var construct is not permitted. Member variables always declare their visibility by using one of the private, protected or public modifiers (We advocate protected and not private). Giving access to member variables directly by declaring them as public is not permitted. If you have a list of multiple properties of the same type you may group them.

	class BackendUsersIndex
	{
		/**
		 * Forms
		 *
		 * @var BackendForm
		 */
		protected $frmLogin, $frmRegister;
	}

## 5. Functions & Methods
### 5.1 Function/method declaration
Functions must be named according to Fork NG’s function naming conventions. Methods inside classes must always declare their visibility by using one of the private, protected or public modifiers. In a class, methods need to be ordered alphabetically starting with __construct & __destruct. There’s always one blank line between methods.

As with classes, the brace should always be written on the line underneath the function name. A space between the function name and the opening parenthesis for the arguments is not permitted. Functions in the globals scope are strongly discouraged. As you can see in the example, there’s no need to place the @return statement, unless you actually have a return value. Extra information about parameters can be placed right after the @param.

	class BackendUsersAdd
	{
		/**
		 * Some method with a return value.
		 *
		 * @return string
		 * @param string $username
		 * @param bool[optional] $isAdmin
		 * @param array[optional] $options
		 *
		 */
		public function parse($username, $isAdmin = true, array $options = array())
		{
		}
		
		/**
		 * Some special method that requires more documentation.
		 *
		 * @return bool If you're a good programmer returns true, otherwise false
		 * @param string $name Insert the name of the programmer you would like to check.
		 */
		public function isGoodProgrammer($name)
		{
			return false;
		}
		
		/**
		 * Some method that does not have any parameters nor a return value.
		 */
		public function enableDebug()
		{
			$this->debug = true;
		}
	}
	
Please note that it's not required to actually document every parameter or return value, if they're pretty straight forward. The case of the function above "isGoodProgrammer" didn't actually need any extended documentation. The 'parse' method on the other hand could have used extended documentation for the '$options' argument since that raises some questions about which options actually exist.

### 5.2 Function/method usage
When passing arrays as arguments to a function, readability should be your top priority. You can either declare the array before passing it to a function or use multiple lines.

	// call function at once
	myFunction(array(
		1, 2, 3, 4, 5, 6, 7, 8,
		'one', 'two', 'three', 'four', 'five',
		$one, $two, $three, $four, $five));
	));
	
	// declare array
	$array = array(
		1, 2, 3, 4, 5, 6, 7, 8,
		'one', 'two', 'three', 'four', 'five',
		$one, $two, $three, $four, $five
	);
	
	// call function
	myFunction($array);

## 6. Control statements
### 6.1 If / else / elseif
Control statements based on the if and elseif constructs may not have a space before the opening parenthesis. Based on the complexity of the if/else statement it should be placed either on one line or multiple lines. If you can use one line and it doesn’t affect the readability, go for it!

	// short if
	$author = ($_GET['author'] != '') ? $_GET['author'] : 'Fork NG';
	
	// simple statement
	if($useXml) $output = '<xml>...</xml>';

Another example, showing when to go for one line and when to split into multiple lines.

	// turquoise
	if($myColor == 'turquoise') echo 'I love it!';
	else echo 'I hate it!';

	// valid email address
	if(Filter::isEmail($email))
	{
		$db->doSomething($email);
		echo 'This email address is valid';
	}	
	
	// invalid email address
	else
	{
		$log->doSomething($email);
		echo 'This email address is invalid';
	}

### 6.2 Switch
Control statements with the 'switch' statement should not have a space before the opening parenthesis of the conditional statement. The opening brace is underneath the switch statement. The default should be at the bottom and have no 'break' statement. Every break should be indented just like the case it belongs to.

	switch($author)
	{
		case 'Davy Hellemans':
			echo 'Hi Davy, how are you?';
		break;
		
		case 'Tijs Verkoyen':
			echo 'Hi Tijs, how are you?';
		break;
		
		// unknown author
		default:
			echo 'Who are you?';
	}

### 6.3 For loop
No space before the opening parenthesis.

	$numUsers = count($users);
	for($i = 0; $i < $numUsers; $i++)
	{
		echo 'Hi there ' . $users[$i] . "\n";
	}

### 6.4 Foreach
There’s no space allowed before the opening parenthesis. Choose a good name for the keys & values inside your loop.

	foreach($users as $id => $user)
	{
		echo "Hi there $user, you are #$id\n";
	}


### 6.5 While & do while
No space allowed before the opening parenthesis. Always use brackets on the line below the opening statement.

	// keep searching
	while(true)
	{
		if(rand(1, 10) == 5) break;
	}
	
	// keep outputting data
	do
	{
		echo 'My name is Michael';
	}
	
	while (1 != 2);

### 6.6 Try catch
Always use brackets on the line underneath the opening statement.

	// create database connection
	try
	{
		$db = new SpoonDatabase('mysq', 'localhost', 'user', 'password', 'database');
	}
	
	// something went wrong
	catch(Exception $e)
	{
		$log->write('There seems to be some problem', $e);
	}

If the statement is very short, you're allowed to place some things on one line.

	try
	{
		for($i = 0; $i < 100; $i++)
		{
			$api->call('getUserDetails', $i);
		}
	}
	
	catch(Exception $e) { $i++; }

## 7. Inline documentation
### 7.1 General
We want you to write a lot of comments. Usefull comments that is. There's no need in commenting every line of code if it's obvious what that little piece of code does. Also keep in mind that you document why you are doing something and not just what, because the 'what' is mostly understood by reading the code.

### 7.2 Format
All documentation blocks must be compatible with the phpDocumentor format.

### 7.3 Files
@tijs - momenteel hebben files nog geen docblock. Handig zou zijn iets algemeen dat niet te veel verandert door versies. Bijkomend is dat nuttig? verplicht? Zie voorbeeld:

	/*
	 * This file is part of Fork CMS.
	 * 
	 * For the full copyright and license information, please view the license
	 * file that was distributed with this source code.
	 */

### 7.4 Classes
The class starts with the description of this specific class, which may use multiple lines. The package & subpackage need to be defined. In case there is no subpackage, this line should not be there. Every developer that works or ever worked on this class should put his name on the list of authors. So if you just added a new method, add your own name to the bottom of the list of authors. Use the same amount of blank lines as you see in the example below.

	/**
	 * This class is used to add a new user to the backend.
	 *
	 * @package backend
	 * @subpackage users
	 *
	 * @author Davy Hellemans <davy.hellemans@netlash.com>
	 * @since 2.6.2
	 */
	class BakendUsersAdd
	{
		// code
	}


### 7.5 Functions/Methods
The comment starts with the description of this function, which may be split into multiple lines if necessary. The @return statement goes before @param statements. Use the same amount of blank lines as shown in the example below.

	class BackendUsersAdd
	{
		/**
		 * Creates the form to add a new user.
		 */
		public function __construct()
		{
			// code
		}
		
		/**
		 * Checks if the given string is a valid URL.
		 *
		 * @return bool
		 * @param string $string
		 */
		function isUrl($string)
		{
			// code
		}
	}


## 8. Naming conventions
In general we try to avoid abbreviations.

## 8.1 Variables
Variable names may only contain alphanumeric characters. Underscores are not permitted. Numbers are permitted, but generally discouraged in most cases. Camelcasing is used to create variables. A few examples:

	$i
	$foo
	$fooBar
	$myExtension
	$redirectUrl
	$myXml

## 8.2 Classes
Classes may only contain alphanumeric characters. Underscores are not permitted. Numbers are permitted, but discouraged in most cases. Camelcasing is used to form class names. A class name should start with an uppercase character. A few examples:

	SpoonFilter
	BackendUser
	FrontendBlogIndex
	SpoonTemplateModifiers

## 8.3 Class properties
The same rules from regular variables are applied. I do want to emphasize the fact that we don’t use underscores to visually show that a variable is private. Public, private & protected should do just fine. A few good examples:

	$name
	$form
	$template
	$frmLogin
	$dbSchema
	
## 8.4 Functions/methods
Functions & methods use the same rules as variables. Their name should be descriptive about what it does. A few examples:

	foo
	doSomething
	readFromFeed
	isAlphabetical

## 8.5 Constants
Constants may only contain alphanumeric characters & underscores. All characters are uppercase. Words are separated by underscores. These rules apply to constants whether or not they are in a class. A few examples:

	SPOON_DEBUG
	PATH
	MAX_LEVENSHTEIN_DISTANCE
