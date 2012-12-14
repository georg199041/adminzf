<?php

/** @var integer First page number (i.e., 1) */
$this->first;

/** @var integer Absolute number of the first item on this page */
$this->firstItemNumber;

/** @var integer First page in the range returned by the scrolling style */
$this->firstPageInRange;

/** @var integer Current page number */
$this->current;

/** @var integer Number of items on this page */
$this->currentItemCount;

/** @var integer Maximum number of items available to each page */
$this->itemCountPerPage;

/** @var integer Last page number */
$this->last;

/** @var integer Absolute number of the last item on this page */
$this->lastItemNumber;

/** @var integer Last page in the range returned by the scrolling style */
$this->lastPageInRange;

/** @var integer Next page number */
$this->next;

/** @var integer Number of pages */
$this->pageCount;

/** @var array Array of pages returned by the scrolling style */
$this->pagesInRange;

/** @var integer Previous page number */
$this->previous;

/** @var integer Total number of items */
$this->totalItemCount;
?>
<?php $push1 = false; ?>
<?php $push2 = false; ?>
<?php
function isViewedPage($object, $page)
{
	if ($object->pageCount <= 11) {
		return true;
	}
	
	if ($object->pageCount > 11) {
		if ($page < 4) {
			return true;
		}
		
		if ($page > $object->pageCount - 3) {
			return true;
		}
		
		if ($page > $object->current - 2 && $page < $object->current + 2) {
			return true;
		}
	}
	
	return false;
}
?>
<?php if ($this->pageCount > 1): ?>
<div class="cbpw-wrapper">
	<!-- First page link -->
		<?php $firstTitle = isset($this->widget->firstTitle) ? $this->widget->firstTitle : 'First'; ?>
		<?php if (isset($this->previous)): ?>
			<a href="<?php echo $this->url(array($this->widget->getRequestPageKey() => $this->first)); ?>"><?php echo $firstTitle; ?></a>
		<?php else: ?>
			<span class="disabled"><?php echo $firstTitle; ?></span>
		<?php endif; ?>
	<!-- /First page link -->
	
	<span class="cbpw-separator">|</span>
	
	<!-- Previous page link -->
		<?php $prevTitle = isset($this->widget->prevTitle) ? $this->widget->prevTitle : 'Previous'; ?>
		<?php if (isset($this->previous)): ?>
			<a href="<?php echo $this->url(array($this->widget->getRequestPageKey() => $this->previous)); ?>"><?php echo $prevTitle; ?></a>
		<?php else: ?>
			<span class="disabled"><?php echo $prevTitle; ?></span>
		<?php endif; ?>
	<!-- Previous page link -->
	
	<span class="cbpw-separator">|</span>

	<!-- Pages numbers -->
	<?php foreach ($this->pagesInRange as $page): ?>
		<?php if (isViewedPage($this, $page)): ?>
			<?php if ($this->current != $page): ?>
				<a href="<?php echo $this->url(array($this->widget->getRequestPageKey() => $page)); ?>"><?php echo $page; ?></a>
			<?php else: ?>
				<span class="disabled"><?php echo $page; ?></span>
			<?php endif; ?>
		<?php else: ?>
		    <?php if ($this->pageCount > 11 && $page < $this->current && !$push1): $push1 = true; ?>
		    	<span>...</span>
		    <?php endif; ?>
			
		    <?php if ($this->pageCount > 11 && $page > $this->current && !$push2): $push2 = true; ?>
		    	<span>...</span>
		    <?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	<!-- /Pages numbers -->
	
	<span class="cbpw-separator">|</span>
	
	<!-- Next page link -->
		<?php $nextTitle = isset($this->widget->nextTitle) ? $this->widget->nextTitle : 'Next'; ?>
		<?php if (isset($this->next)): ?>
			<a href="<?php echo $this->url(array($this->widget->getRequestPageKey() => $this->next)); ?>"><?php echo $nextTitle; ?></a>
		<?php else: ?>
			<span class="disabled"><?php echo $nextTitle; ?></span>
		<?php endif; ?>
	<!-- /Next page link -->
	
	<span class="cbpw-separator">|</span>
	
	<!-- Last page link -->
		<?php $lastTitle = isset($this->widget->lastTitle) ? $this->widget->lastTitle : 'Last'; ?>
		<?php if (isset($this->next)): ?>
			<a href="<?php echo $this->url(array($this->widget->getRequestPageKey() => $this->last)); ?>"><?php echo $lastTitle; ?></a>
		<?php else: ?>
			<span class="disabled"><?php echo $lastTitle; ?></span>
		<?php endif; ?>
	<!-- /Last page link -->
</div>
<?php endif; ?>
















