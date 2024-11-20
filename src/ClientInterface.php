<?php

namespace phpcent;

/**
 * Centrifugo API Client
 *
 * @package    phpcent
 * @copyright  Copyright (c) 2019 Centrifugal
 * @license    The MIT License (MIT)
 */
interface ClientInterface
{
    /**
     * Publish data into channel.
     *
     * @param  string   $channel
     * @param  array    $data
     * @param  boolean  $skipHistory  (optional)
     *
     * @return mixed
     */
    public function publish($channel, $data, $skipHistory = false);

    /**
     * Broadcast the same data into multiple channels.
     *
     * @param  array    $channels
     * @param  array    $data
     * @param  boolean  $skipHistory  (optional)
     *
     * @return mixed
     */
    public function broadcast($channels, $data, $skipHistory = false);

    /**
     * Subscribe user to channel.
     *
     * @param  string  $channel
     * @param  string  $user
     * @param  string  $client  (optional)
     *
     * @return mixed
     */
    public function subscribe($channel, $user, $client = '');

    /**
     * Unsubscribe user from channel.
     *
     * @param  string  $channel
     * @param  string  $user
     * @param  string  $client  (optional)
     *
     * @return mixed
     */
    public function unsubscribe($channel, $user, $client = '');

    /**
     * Disconnect user.
     *
     * @param  string  $user
     * @param  string  $client  (optional)
     *
     * @return mixed
     */
    public function disconnect($user, $client = '');

    /**
     * Get channel presence info.
     *
     * @param  string  $channel
     *
     * @return mixed
     */
    public function presence($channel);

    /**
     * Get channel presence stats.
     *
     * @param  string  $channel
     *
     * @return mixed
     */
    public function presenceStats($channel);

    /**
     * Get channel history.
     *
     * @param  string   $channel
     * @param  int      $limit    (optional)
     * @param  array    $since    (optional)
     * @param  boolean  $reverse  (optional)
     *
     * @return mixed
     */
    public function history($channel, $limit = 0, $since = array(), $reverse = false);

    /**
     * Get all active channels.
     *
     * @param  string  $pattern  (optional)
     *
     * @return mixed
     */
    public function channels($pattern = '');

    /**
     * Get server info.
     *
     * @return mixed
     */
    public function info();

    /**
     * Sending many commands in one request
     *
     * @param  array  $data
     *
     * @return mixed
     */
    public function batch(array $data);

    /**
     * Generate connection JWT. See https://centrifugal.dev/docs/server/authentication.
     * Keep in mind that this method does not support all claims of Centrifugo JWT connection
     * token at this point. You can use any JWT library to generate Centrifugo tokens.
     *
     * @param  string  $userId  - current user ID as string.
     * @param  int     $exp     - time in the future as unix seconds for token expiration.
     * @param  array   $info
     * @param  array   $channels
     * @param  array   $meta
     *
     * @return string
     */
    public function generateConnectionToken($userId, $exp = 0, $info = array(), $channels = array(), $meta = array());

    /**
     * Generate subscription JWT. See https://centrifugal.dev/docs/server/channel_token_auth.
     * Keep in mind that this method does not support all claims of Centrifugo JWT subscription
     * token at this point. You can use any JWT library to generate Centrifugo tokens.
     *
     * @param  string  $userId   - current user ID as string.
     * @param  string  $channel  - channel token generated for.
     * @param  int     $exp      - time in the future as unix seconds for token expiration.
     * @param  array   $info
     *
     * @return string
     */
    public function generateSubscriptionToken($userId, $channel, $exp = 0, $info = array());
}
