<?php
/**
 * @package     Joomla.Platform
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.filesystem.path');

/**
 * Joomla Platform HTML View Class
 *
 * @since  12.1
 */
abstract class JViewHtml extends JViewBase
{
  /**
   * The view layout.
   *
   * @var    string
   * @since  12.1
   */
  protected $layout = 'default';

  /**
   * The paths queue.
   *
   * @var    SplPriorityQueue
   * @since  12.1
   */
  protected $paths;

  /* will override the template path */
  protected $_path = array('template' => array(), 'helper' => array());

  /**
   * Method to instantiate the view.
   *
   * @param   JModel            $model  The model object.
   * @param   SplPriorityQueue  $paths  The paths queue.
   *
   * @since   12.1
   */
  public function __construct(JModel $model, SplPriorityQueue $paths = null)
  {
    parent::__construct($model);

    // Setup dependencies.
    $this->paths = isset($paths) ? $paths : $this->loadPaths();

    /* T3: Add T3 html path to the priority paths of component view */
    // T3 html path
    $component = JApplicationHelper::getComponentName();
    $component = preg_replace('/[^A-Z0-9_\.-]/i', '', $component);
    $t3Path = T3_PATH . '/html/' . $component . '/' . $this->getName();
    // Setup the template path
    $this->paths->top();
    $defaultPath = $this->paths->current();
    $this->paths->next();
    $templatePath = $this->paths->current();
    // add t3 path
    $this->paths->insert($t3Path,3);

    $this->_path['template'] = array($defaultPath, $t3Path, $templatePath);
    /* //T3 */
  }

  /**
   * Magic toString method that is a proxy for the render method.
   *
   * @return  string
   *
   * @since   12.1
   */
  public function __toString()
  {
    return $this->render();
  }

  /**
   * Method to escape output.
   *
   * @param   string  $output  The output to escape.
   *
   * @return  string  The escaped output.
   *
   * @see     JView::escape()
   * @since   12.1
   */
  public function escape($output)
  {
    // Escape the output.
    return htmlspecialchars($output, ENT_COMPAT, 'UTF-8');
  }

  /**
   * Method to get the view layout.
   *
   * @return  string  The layout name.
   *
   * @since   12.1
   */
  public function getLayout()
  {
    return $this->layout;
  }

  /**
   * Method to get the layout path.
   *
   * @param   string  $layout  The layout name.
   *
   * @return  mixed  The layout file name if found, false otherwise.
   *
   * @since   12.1
   */
  public function getPath($layout)
  {
    // Get the layout file name.
    $file = JPath::clean($layout . '.php');

    // Find the layout file path.
    $path = JPath::find(clone $this->paths, $file);

    return $path;
  }

  /**
   * Method to get the view paths.
   *
   * @return  SplPriorityQueue  The paths queue.
   *
   * @since   12.1
   */
  public function getPaths()
  {
    return $this->paths;
  }

  /**
   * Method to render the view.
   *
   * @return  string  The rendered view.
   *
   * @since   12.1
   * @throws  RuntimeException
   */
  public function render()
  {
    // Get the layout path.
    $path = $this->getPath($this->getLayout());

    // Check if the layout path was found.
    if (!$path)
    {
      throw new RuntimeException('Layout Path Not Found');
    }

    // Start an output buffer.
    ob_start();

    // Load the layout.
    include $path;

    // Get the layout contents.
    $output = ob_get_clean();

    return $output;
  }

  /**
   * Method to set the view layout.
   *
   * @param   string  $layout  The layout name.
   *
   * @return  JViewHtml  Method supports chaining.
   *
   * @since   12.1
   */
  public function setLayout($layout)
  {
    $this->layout = $layout;

    return $this;
  }

  /**
   * Method to set the view paths.
   *
   * @param   SplPriorityQueue  $paths  The paths queue.
   *
   * @return  JViewHtml  Method supports chaining.
   *
   * @since   12.1
   */
  public function setPaths(SplPriorityQueue $paths)
  {
    $this->paths = $paths;

    return $this;
  }

  /**
   * Method to load the paths queue.
   *
   * @return  SplPriorityQueue  The paths queue.
   *
   * @since   12.1
   */
  protected function loadPaths()
  {
    return new SplPriorityQueue;
  }
}
