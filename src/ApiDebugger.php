<?php

namespace HasanH47\ApiDebugger;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiDebugger
{
  /**
   * Dump the given variables and end the script.
   *
   * @param  mixed  ...$args
   * @return void
   */
  public static function dd(...$args)
  {
    self::sendResponse($args, true);
  }

  /**
   * Dump the given variables without ending the script.
   *
   * @param  mixed  ...$args
   * @return void
   */
  public static function dump(...$args)
  {
    self::sendResponse($args, false);
  }

  /**
   * Send the response as JSON with the dumped data.
   *
   * @param  mixed  $data
   * @param  bool   $terminate
   * @return void
   */
  protected static function sendResponse($data, $terminate = true)
  {
    // Format data for better readability
    $formattedData = array_map(function ($item) {
      return is_array($item) ? self::formatArray($item) : $item;
    }, $data);

    $response = new JsonResponse([
      'debug' => $formattedData,
      'trace' => self::getTrace(),
      'message' => 'Debugging information provided by LaravelApiDebugger.'
    ]);

    $response->headers->set('Content-Type', 'application/json');
    $response->send();

    if ($terminate) {
      exit;
    }
  }

  /**
   * Format an array with more readable structure.
   *
   * @param  array  $array
   * @return array
   */
  protected static function formatArray(array $array)
  {
    return array_map(function ($item) {
      return is_array($item) ? self::formatArray($item) : $item;
    }, $array);
  }

  /**
   * Get a formatted stack trace.
   *
   * @return array
   */
  protected static function getTrace()
  {
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    return array_map(function ($frame) {
      return [
        'file' => $frame['file'] ?? 'N/A',
        'line' => $frame['line'] ?? 'N/A',
        'function' => $frame['function'] ?? 'N/A',
        'class' => $frame['class'] ?? 'N/A',
        'type' => $frame['type'] ?? 'N/A',
      ];
    }, $trace);
  }
}
