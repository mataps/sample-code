<?php namespace Mataps\Forms;

interface BaseFormInterface {

	function save($data);

	function deleteById($id);

	function errors();
}