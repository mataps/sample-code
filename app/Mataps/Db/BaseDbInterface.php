<?php namespace Mataps\Db;

interface BaseDbInterface
{
	function getAll();

	function byPage($page=1, $limit=10, $all=false);

	function byId($id);
}