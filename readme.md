# Fork CMS coding standards
## 1. General
### 1.1 Encoding
Files need to be encoded using _UTF-8_
### 1.2 Line endings
Only unix line endings _\n_ are allowed.
### 1.3 Tabs
Code is indented using tabs. The display width of 1 tab is equal to 4 spaces.
### 1.4 Opening/closing tags
Never use short open stags. Always go for the standard PHP tags. Note that we do NOT use a closing tag and end the file with a newline.

	<?php
	
	// my code goes here...
	
## 2. Strings
### 2.1 Literal strings
Literal strings should always be demarcaated with single quotes.

	$string = 'this is my string';

### 2.2 Variable substitution
We don't allow double quotes to demarcate strings containing variables.

	$string = 'Helly name is ' . $name;
	$string = 'Hi there ' . $name . ', How are you?';
	
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

	class BackendUsersAdd extend BackendAction implements Backend, Users, Action
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
### 5.2 Function/method usage

## 6. Control statements
### 6.1 If / else / elseif
### 6.2 Switch
### 6.3 For loop
### 6.4 Foreach
### 6.5 While & do while
### 6.6 Try catch

## 7. Inline documentation
### 7.1 Format
### 7.2 Files
### 7.3 Classes
### 7.4 Functions/Methods

## 8. Naming conventions
## 8.1 Variables
## 8.2 Classes
## 8.3 Class properties
## 8.4 Functions/methods
## 8.5 Constants