<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Ip_Tabmegamenu_Block_Navigation extends Mage_Core_Block_Template {

    
    protected function _construct() {
        $this->addData(array(
            'cache_lifetime' => 86400,
            'cache_tags' => array("magazento_tabmegamenu" .'_'.Mage::app()->getStore()->getId()),
            'cache_key' => "magazento_tabmegamenu".'_'.Mage::app()->getStore()->getId(),
        ));            
    }
            
    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getStoreConfig('tabmegamenu/system/includelivepipe'))
                $this->getLayout()->getBlock('head')->addJs('ip_tabbedmegamenu/livepipe.js');
        $this->getLayout()->getBlock('head')->addJs('ip_tabbedmegamenu/tabs.js');		
    }
    
	
    public function drawItem($category=0,$item,$class) {
        $userows =Mage::getStoreConfig('tabmegamenu/options/userows');
        //$url=$this->getCategoryUrl($category);
        $url = Mage::getModel("catalog/category")->load($category->getId())->getUrl();
        if ($item['url']!='') $url=$item['url'];

        $html = '<li class="drop menu_'.$item['align_category'].' '.$class.'">';
        $html.= '<a class="drop" href="' . $url . '">' . $this->htmlEscape($item['title']) . '</a>' . "\n";
            $activeChildren = $this->getActiveChildren($category);
            if (sizeof($activeChildren) > 0) {
                $html .= $this->drawColumns($activeChildren,$item);
            }
        $html .= "</li>";

        return $html;
    }
    
    public function array_chunk_fixed($input, $num, $preserve_keys = FALSE) {
        $count = count($input) ;
        if($count)
            $input = array_chunk($input, ceil($count/$num), $preserve_keys) ;
        $input = array_pad($input, $num, array()) ;
        return $input ;
    }
    
    public function drawColumns($children,$item) {
        $col=$item['column'];
        $html = '';
        $chunks = $this->array_chunk_fixed($children, $col);
        $html .= '<div class="dropdown_'.$col.'column align_'.$item['align_content'].' ">';
		$helper = Mage::helper('cms');
		$processor = $helper->getPageTemplateProcessor();
		
		
            $html .= '<div class="col_'.$col.'"><div class="content_top">';
			$html .= $processor->filter($item['content_top']);       
			
            $html .= '</div></div>';

                foreach ($chunks as $key => $value) {
                    $html .= '<div class="col_1">';
                    $html .= $this->drawNestedMenus($value, 1);
                    $html .= '</div>';
                }

            $html .= '<div class="col_'.$col.'"><div class="content_bottom">';
			$html .= $processor->filter($item['content_bottom']);     			
            $html .= '</div></div>';

        $html .= '</div>';
        return $html;
    }

    public function drawNestedMenus($children, $level=1,$morehref ='') {
        $moretext=Mage::getStoreConfig('tabmegamenu/options/moretext');
        $maxsubcatnum=Mage::getStoreConfig('tabmegamenu/options/maximumsubcat');

        $html = '<ul>';
        $i=0;
        foreach ($children as $child) {
            if ($child->getIsActive()) {
                $url = Mage::getModel("catalog/category")->load($child->getId())->getUrl();
                $html .= '<li class="level' . $level . '">';
                $html .= '<a href="' . $url . '"><span class="level' . $level . '">' . $this->htmlEscape($child->getName()) . '</span></a>';
                
                
                $activeChildren = $this->getActiveChildren($child);
                if (sizeof($activeChildren) > 0) {
                    $html .= $this->drawNestedMenus($activeChildren, $level + 1,$url);
                }
                $i++;
                $html .= '</li>';
                if ($i==$maxsubcatnum) {
                    $html .= '<li class="level' . $level . '">';
                    $html .= '<a href="'.$morehref.'"><span class="viewall level' . $level . '">'.$moretext.'</span></a>';
                    $html .= '</li>';
                    break;
                }
            }
        }
        $html .= '</ul>';
        return $html;
    }

    protected function getActiveChildren($parent) {
        $activeChildren = array();
        if (Mage::helper('catalog/category_flat')->isEnabled()) {
            $children = $parent->getChildrenNodes();
            $childrenCount = count($children);
        } else {
            $children = $parent->getChildren();
            $childrenCount = count($children);
        }
        $hasChildren = $children && $childrenCount;
        if ($hasChildren) {
            foreach ($children as $child) {
                if ($child->getIsActive()) {
                    array_push($activeChildren, $child);
                }
            }
        }
        return $activeChildren;
    }

    public function getCategoryPath($category) {
        $url = '';
        if ($category instanceof Mage_Catalog_Model_Category) {
            $url = $category->getPathInStore();
            $url = strtr($url, ".", "-");
            $url = strtr($url, "/", "-");
        } else {
            // do nothing
        }
        return $url;
    }

// -----------------------------------------------------------------------------
	public function drawTabmegamenuTabs() {
        $html = '';
        $data = Mage::getModel('tabmegamenu/data')->getTabs();
		$html='';
        $i=0;
        foreach ($data as $item) {
            $i++;
		    $class="";$style="";
            if ($i == (count($data))) $class= ' last';
            if ($i == 1 ) $class= ' first';

            if ($item->getcssClass()) $class = $class. ' '.$item->getcssClass();
            if ($item->getcssStyle()) $style = 'style="'.$item->getcssStyle().'"';

            if ($item->getType() == 1 )
                    $html .= '<li class="tab'. $class .' '.$item['align_tab'].'"><a onmouseover="updateMenuTab('.$i.')"  onclick="return false" '.$style.' href="#menu'.$i.'">'.$item['title'].'</a></li>';
            if ($item->getType() == 0 )
                $html .= '<li class="tab'. $class .' '.$item['align_tab'].'"><a '.$style.' href="'.$item->getUrl().'">'.$item['title'].'</a></li>';

        }

        return $html;
    }
	
	
	public function drawTabmegamenuTabItems() {
		$html='';
      	$data = Mage::getModel('tabmegamenu/data')->getTabs();
		$i=0;
		foreach ($data as $item) {
			$i++;
     		$tab_id = $item->getId();
			if ($item->getType() == 1 ) {
				$class="";$style="";			
				if ($item->getcssClassContent()) $class = 'class="'.$item->getcssClassContent().'" '; 
				if ($item->getcssStyleContent()) $style = 'style="'.$item->getcssStyleContent().'" '; 	
				$display = '';
				if ($i>1) $display = 'style="display: none;"';		
				$html.='<div '.$display.' onmouseover="updateMenuTab('.$i.')"  id="menu'.$i.'" >
						<ul '.$class.$style.' id="menu">';
					if (Mage::getStoreConfig('tabmegamenu/options/homebutton')){
						$html.='<li class=" home-link">';
						$html.='<a class="drop" href="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'"> &nbsp; </a>';
						$html.='</li>';
					}
					
					$html.= $this -> drawCatalog($tab_id);
						
					if (Mage::getStoreConfig('tabmegamenu/allpages/enable')){
						$itemAlign = Mage::getStoreConfig('tabmegamenu/allpages/itemalign');
						$contentAlign = Mage::getStoreConfig('tabmegamenu/allpages/contentalign');
						$title = Mage::getStoreConfig('tabmegamenu/allpages/title');
						$storeId = Mage::app() -> getStore() -> getId();
						$storeUrl = Mage::getModel('core/store') -> load($storeId) -> getUrl();
						$storeUrl .= '#';
						
						$title = Mage::getStoreConfig('tabmegamenu/allpages/title');
						$html.='<li class="drop menu_'.$itemAlign.' allcategories">';
							$html.='<a href="'.$storeUrl.'" class="drop">'.$title.'</a>';
							$html.='<div class="dropdown_2column_simple align_'.$contentAlign.'">';
								$html.='<div class="col_1">';
									$html.='<ul class="simple">';
										$html.= $this->drawAllCategoriesMenu();
									$html.='</ul>';
								$html.='</div>';
							$html.='</div>';
						$html.='</li>';
					}
					$html.= $this->drawAdminMenu($tab_id,$i);
				$html.= '</ul>
						 </div> ';		
			}
		}		
		return $html;
	}			
	
	public function drawCatalog($tab_id) {
        $html='';
        $data = Mage::getModel('tabmegamenu/data')->getCatalog($tab_id);
        $i=0;
        foreach ($data as $key => $item) {
            $i++;
            $categoryId = $item['catalog_id'];
            $categoryObject = Mage::getModel('catalog/category')->load($categoryId);
            $categoryParentId = $categoryObject->getParentId();
            foreach (Mage::helper('tabmegamenu/data')->getSubCategories($categoryParentId) as $_category) {
                if ($_category->getId() == $categoryId) {
                    $class = 'category'.$categoryId;
                  //  if ($i == 1) $class.= ' first';
                  //  if ($i == (count($data))) $class.= ' last';
                    $html.=$this->drawItem($_category,$item,$class);
                }
            }

        }
        return $html;
    }
    
    
    // -----------------------------------------------------------------------------
    public function drawAllCategoriesMenu() {
        $html = '';
        $collection =$helper = Mage::helper('catalog/category')->getStoreCategories();
        foreach ($collection as $node) {
            if ($node->getData('level') == 2) {
                $html .= '<li>';
                $url = Mage::getModel("catalog/category")->load($node->getId())->getUrl();
                $html .= '<a href="' . $url. '">' . $node->getData('name') . '</a>';
                $html .= '</li>';
            }
        }
        return $html;
    }


    public function drawAdminMenu($tab_id,$tab_number) {
        $storeId  = Mage::app()->getStore()->getId();
        $storeUrl = Mage::getModel('core/store')->load($storeId)->getUrl();
        $storeUrl.='#';
        $class = '';
        $data=Mage::getModel('tabmegamenu/data')->getItems($tab_id);
        $html='';
        $i=0;
		$helper = Mage::helper('cms');
		$processor = $helper->getPageTemplateProcessor();
		 
        foreach ($data as $item) {
                $i++;
                //if ($i == (count($data))) $class= ' last';
                $url=$storeUrl;
				if ($item['column'] > 0) {
	                if ($item['url']!='') $url=$item['url'];
	                $html .= '<li class="drop menu_'.$item['align_item'].' '. $class .'">';
	                $html .= '<a href="'.$url.'" class="drop">'.$item['title'].' '.$item['store_id'].' '.$item['tab_id'].'</a>';
	                $html .= '<div onmouseover="updateMenuTab('.$i.')" class="dropdown_'.$item['column'].'column align_'.$item['align_content'].'">';
	                $html .= '<div class="col_'.$item['column'].'">';
	               // $html .= $item['content'];
					$html .= $processor->filter($item['content']);       
	                $html .= '</div>';
	                $html .= '</div>';
	                $html .= '</li>';
				}
				if ($item['column'] == 0) {
	                if ($item['url']!='') $url=$item['url'];
	                $html .= '<li class="drop menu_'.$item['align_item'].' '. $class .'">';
	                $html .= '<a href="'.$url.'" class="drop">'.$item['title'].' '.$item['store_id'].' '.$item['tab_id'].'</a>';
	                $html .= '</li>';
				}				
				
				

        }
        return $html;
    }

}