<?php
// Copyright (C) 2018 Combodo SARL
//
//   This file is part of iTop.
//
//   iTop is free software; you can redistribute it and/or modify
//   it under the terms of the GNU Affero General Public License as published by
//   the Free Software Foundation, either version 3 of the License, or
//   (at your option) any later version.
//
//   iTop is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU Affero General Public License for more details.
//
//   You should have received a copy of the GNU Affero General Public License
//   along with iTop. If not, see <http://www.gnu.org/licenses/>


/**
 * <p>Stores data for {@link AttributeTagSet} fields
 *
 * <p>We will have an implementation for each class/field to be able to customize rights (generated in \MFCompiler::CompileClass).<br>
 * Only this abstract class will exists in the DB : the implementations won't had any new field.
 *
 * @since 2.6 N°931 tag fields
 */
abstract class TagSetFieldData extends cmdbAbstractObject
{
    public static function Init()
    {
        $aParams = array
        (
            'category' => 'bizmodel',
            'key_type' => 'autoincrement',
            'name_attcode' => array('tag_label'),
            'state_attcode' => '',
            'reconc_keys' => array('tag_code'),
            'db_table' => 'priv_tagfielddata',
            'db_key_field' => 'id',
            'db_finalclass_field' => 'finalclass',
        );

        MetaModel::Init_Params($aParams);
        MetaModel::Init_InheritAttributes();

        MetaModel::Init_AddAttribute(new AttributeString("tag_code", array(
            "allowed_values" => null,
            "sql" => 'tag_code',
            "default_value" => '',
            "is_null_allowed" => false,
            "depends_on" => array()
        )));
        MetaModel::Init_AddAttribute(new AttributeString("tag_label", array(
            "allowed_values" => null,
            "sql" => 'tag_label',
            "default_value" => '',
            "is_null_allowed" => false,
            "depends_on" => array()
        )));
        MetaModel::Init_AddAttribute(new AttributeString("tag_description", array(
            "allowed_values" => null,
            "sql" => 'tag_description',
            "default_value" => '',
            "is_null_allowed" => true,
            "depends_on" => array()
        )));
        MetaModel::Init_AddAttribute(new AttributeString("tag_class", array(
            "allowed_values" => null,
            "sql" => 'tag_class',
            "default_value" => '',
            "is_null_allowed" => false,
            "depends_on" => array()
        )));
        MetaModel::Init_AddAttribute(new AttributeString("tag_attcode", array(
            "allowed_values" => null,
            "sql" => 'tag_attcode',
            "default_value" => '',
            "is_null_allowed" => false,
            "depends_on" => array()
        )));


        MetaModel::Init_SetZListItems('details', array('tag_code', 'tag_label', 'tag_description'));
        MetaModel::Init_SetZListItems('standard_search', array('tag_code', 'tag_label', 'tag_description'));
        MetaModel::Init_SetZListItems('list', array('tag_code', 'tag_label', 'tag_description'));
    }

	public function ComputeValues()
	{
		$sClassName = get_class($this);
		// Extract class and attcode from class name using pattern  TagSetFieldDataFor_<class>_<attcode>>;
		if (preg_match('@^TagSetFieldDataFor_(?<class>\w+)_(?<attcode>\w+)$@', $sClassName, $aMatches))
		{
			$this->_Set('tag_class', $aMatches['class']);
			$this->_Set('tag_attcode', $aMatches['attcode']);
		}
	}
}