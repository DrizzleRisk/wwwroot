<?php

namespace Home\Controller;
use Think\Controller;
class StatisticsController extends Controller {
	public function index() {
		$this->display();
	}
	public fucntion k12() {
		$this->display();
	}
	public fucntion test() {
		$this->display();
	}
	public function vulCount() {
		// $Risk = M('risk');
		// $conn['ischeck'] = 1;
		// $Risk_record = $Risk->field('id,riskname')->where($conn)->order('risklevel desc')->select();
		//riskid!=22 and riskid!=23 and riskid!=24
		$File = M('file');
		$all = $File->where('status=2')->count();

		$analysis = M('Analysis');
		$data = $analysis->field(array('risk.riskname','count(*) as count_risk'))->join('risk ON analysis.riskid = risk.id')->
		where('verdict=2 and risk.ischeck=1')->group('riskid')->order('count_risk asc')->select();

		$data_safe = $analysis->field(array('risk.riskname','count(*) as count_safe'))->join('risk ON analysis.riskid = risk.id')->
		where('verdict=1 and risk.ischeck=1')->group('riskid')->order('count_safe desc')->select();
		for($i=0; $i<count($data); $i++) {
			$c = count($data_safe);
			for($j=0; $j<$c; $j++) {
				if($data_safe[$j]['riskname'] == $data[$i]['riskname']) {
					$data[$i]['count_safe'] = $data_safe[$j]['count_safe'];
					break;
				}
				if($j == $c) {
					$data[$i]['count_safe'] = '0';
				}
			}
		}
		$r['ec_data'] = $data;
		$r['chk_all'] = $all;
		$this->ajaxReturn($r);
	}
}