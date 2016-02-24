<?php
/*
 * Copyright 2007-2015 Abstrium <contact (at) pydio.com>
 * This file is part of Pydio.
 *
 * Pydio is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Pydio is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Pydio.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://pyd.io/>.
 */

namespace Pydio\OCS\Model;
defined('AJXP_EXEC') or die('Access not allowed');


class TargettedLink extends \ShareLink
{
    public function __construct($store, $storeData = array()){
        parent::__construct($store, $storeData);
        $this->store = $store;
        $this->internal = $storeData;
        $this->internal["TARGET"] = "remote";
    }

    /**
     * @param string $remoteServer
     * @param string $remoteUser
     * @return ShareInvitation
     */
    public function createInvitation($remoteServer, $remoteUser){

        $invitation = new ShareInvitation();
        $invitation->setStatus(OCS_INVITATION_STATUS_PENDING);
        $invitation->setLinkHash($this->getHash());
        $invitation->setOwner($this->getOwnerId());
        $invitation->setTargetHost($remoteServer);
        $invitation->setTargetUser($remoteUser);

        return $invitation;

    }

}