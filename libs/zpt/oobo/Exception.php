<?php
/**
 * =============================================================================
 * Copyright (c) 2010, Philip Graham
 * All rights reserved.
 *
 * This file is part of OO-bo and is licensed by the Copyright holder under the
 * 3-clause BSD License.  The full text of the license can be found in the
 * LICENSE.txt file included in the root directory of this distribution or at
 * the link below.
 * =============================================================================
 *
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
namespace zpt\oobo;

/**
 * This class is used for exceptions that occur from within the library's
 * classes.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Exception extends \Exception {

  /**
   * Create a new OO-bo exception
   *
   * @param string $msg The exception's message.
   * @param integer|Exception $code Either the exception's code or the causing
   *     exception.
   * @param Exception $previous The exception that is the reason this exception
   *     is being thrown.
   */
  public function __construct($msg, $code = 0, \Exception $previous = null) {
    $msg = 'OO-bo: ' . $msg;

    if ($code instanceof \Exception) {
      $previous = $code;
      $code = 0;
    }
    parent::__construct($msg, $code, $previous);
  }
}
