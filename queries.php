<?php

// bad
$items = (array) BackendModel::getDB()->getRecords('SELECT i.id AS url, i.title AS name, mt.module
													FROM modules_tags AS mt
													INNER JOIN tags AS t ON mt.tag_id = t.id
													INNER JOIN blog_posts AS i ON mt.other_id = i.id
													WHERE mt.module = ? AND mt.tag_id = ? AND i.status = ? AND i.language = ?',
													array('blog', (int) $tagId, 'active', BL::getWorkingLanguage()));

// better
$items = (array) BackendModel::getDB()->getRecords(
	'SELECT i.id AS url, i.title AS name, mt.module
	 FROM modules_tags AS mt
	 INNER JOIN tags as t ON mt.tag_id = t.id
	 INNER JOIN blog_posts AS i ON mt.other_id = i.id
	 WHERE mt.module = ? AND mt.tag_id = ? AND i.status = ? AND i.language = ?',
	array('blog', (int) $tagId, 'active', BL::getWorkingLanguage())
);
