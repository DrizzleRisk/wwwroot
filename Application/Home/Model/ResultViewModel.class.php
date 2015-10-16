<?php
namespace Home\Model;
use Think\Model\ViewModel;
class ResultViewModel extends ViewModel {
	public $viewFields = array(
		'Analysis' => array('id', 'fileid', 'result', 'verdict'),
		'Risk' => array('id'=>'risk_id', 'class', 'riskname', 'risklevel', 'riskdetail', 'fixes', '_on'=>'Analysis.riskid=Risk.id')	
	);
}
