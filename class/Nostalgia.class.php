<?php

	/**************************************************************************/
	/**************************************************************************/

	class Nostalgia
	{
		/**********************************************************************/
		
		private $path;
		private $request;
		
		private $config;
		private $configDefault;
		
		/**********************************************************************/
		
		function __construct($config=null,$configDefault=null)
		{
			$this->path=null;
			$this->request=null;
			
			$this->config=$config;
			$this->configDefault=$configDefault;
			
			$request=@$_GET['_escaped_fragment_'];
			
			if(strlen($request)) 
			{				
				$this->request=$request;
				
				if(in_array($this->request,array('main','menu'))) return;
				
				$this->path='page/'.$this->request;
				
				if(!file_exists($this->path))
				{
					$this->path=null;
					$this->request=null;
				}
			}
		}
		
		/**********************************************************************/
		
		public function loadFile()
		{
			if(is_null($this->request)) return;
			if(in_array($this->request,array('main','menu'))) return;
			
			require_once($this->path);
		}
		
		/**********************************************************************/
		
		public function getURL($request)
		{
			return((!is_null($this->request) ? '?_escaped_fragment_=' : '#!').$request);
		}
		
		/**********************************************************************/
		
		public function _getURL($page)
		{
			echo $this->getURL($page);
		}
		
		/**********************************************************************/
		
		public function getRequestType()
		{
			return(is_null($this->request) ? 1 : 2);
		}
		
		/**********************************************************************/
		
		public function getRequest()
		{
			return($this->request);
		}
		
		/**********************************************************************/
		
		public function getTitle()
		{
			return($this->getMeta('title'));
		}
		
		/**********************************************************************/
		
		public function getKeywords()
		{
			return($this->getMeta('keywords'));
		}
		
		/**********************************************************************/
		
		public function getDescription()
		{
			return($this->getMeta('description'));
		}
		
		/**********************************************************************/
		
		public function getMeta($name)
		{
			$meta=$this->config[$this->request][$name];
			if(strlen(trim($meta))>0) return($meta);
			return($this->configDefault[$name]);				
		}
		
		/**********************************************************************/
	}
	
	/**************************************************************************/
	/**************************************************************************/
?>
