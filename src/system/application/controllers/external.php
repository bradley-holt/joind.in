<?php

class External extends Controller {
	
	public function External(){
		parent::Controller();
	}
	
	public function twitter_event_add(){
		if(!defined('IS_CRON')){ return false; }
		
		//http://conf.localhost/event/hot
		$this->load->library('twitter');
		$this->load->model('event_model');
		
		$events=$this->event_model->getUpcomingEvents(null);
		
		$msg = $this->config->item('site_name') . " Update: There's ".count($events)." great events coming up soon! ";
		$msg.="Check them out! " . $this->config->site_url() . "event/upcoming";
		
		$resp=$this->twitter->sendMsg($msg);
	}
	public function twitter_popular_talks(){
		//send a message to twitter with some of the popular talks
	}
	public function twitter_latest_blog(){
		if(!defined('IS_CRON')){ return false; }
		$this->load->model('blog_posts_model','bpm');
		
		$detail=$this->bpm->getPostDetail();
		//print_r($detail[0]);
		
		$msg = $this->config->item('site_name') . ' Update: Latest blog post - '.$detail[0]->title.' ';
		$msg .= $this->config->site_url() . 'blog/view/'.$detail[0]->ID;
		
		$resp=$this->twitter->sendMsg($msg);
	}
}

?>