<?php
namespace Home\Model;
use Think\Model\RelationModel;


class CommentModel extends RelationModel
{
    public $_validate = array('content','6,200','test','1','length','3');
}