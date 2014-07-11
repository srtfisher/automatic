<?php namespace Srtfisher\Automatic\Laravel;

interface AutomaticUserInterface
{
  /**
   * Retrieve the User Token
   *
   * @return string|void
   */
  public function getAutomaticAccessToken();
}
