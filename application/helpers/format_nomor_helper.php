<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function formatNomorTelepon($nomor)
{
    // Misalkan kita ingin format +62821-4031-2xxx
    return substr($nomor, 0, 6) . '-' . substr($nomor, 6, 4) . '-' . substr($nomor, 10);
}
