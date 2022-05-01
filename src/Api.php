<?php




class Api
{

    protected $config;

    public function __construct($ip, $token)
    {

        $this->config = array(
            'ip' => $ip,
            'token' => $token
        );
    }



    public function get_data($method, $params = "", $offset = "")
    {
        $token = $this->config['token'];
        $ip = $this->config['ip'];


        $json = '{
                "method": "' . $method . '",
                "token": "' . $token . '"
            }';
        echo $ip;

        $content = $json;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $ip);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array("Content-type: application/json")
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($json_response, true);
        return $response;
    }

    public function getSystemInfo()
    {
        return get_data("getSystemInfo");
    }

    public function getProfileStatus()
    {
        return $this->get_data("getProfileStatus");
    }

    public function setProfileStatus($status, $mood)
    {
        $params = '{
                "status": "' . $status . '",
                "mood": "' . $mood . '"
            }';
        return $this->get_data("setProfileStatus", $params);
    }

    public function getReleaseNotes()
    {
        return $this->get_data("getReleaseNotes");
    }

    public function getSettingInfo($settingId)
    {
        $params = '{
                "settingId": "' . $settingId . '"
            }';
        return $this->get_data("getSettingInfo");
    }

    public function setSettingInfo($settingId, $newValue)
    {
        $params = '{
                "settingId": "' . $settingId . '",
                "newValue": "' . $newValue . '"
            }';
        return $this->get_data("setSettingInfo", $params);
    }

    public function getOwnContact()
    {
        return $this->get_data("getOwnContact");
    }

    public function setProfileData($nick = "", $firstName = "", $lastName = "")
    {
        $params = '{
                "nick": "' . $nick . '",
                "firstName": "' . $firstName . '",
                "lastName": "' . $lastName . '"
            }';
        return $this->get_data("setProfileData", $params);
    }

    public function getContactGroups()
    {
        return $this->get_data("getContactGroups");
    }
    public function getContactsByGroup($groupName)
    {
        $params = '{
                "groupName": "' . $groupName . '"
            }';
        return $this->get_data("getContactsByGroup", $params);
    }

    public function getContacts($filter = "")
    {
        $params = '{
                "filter": "' . $filter . '"
            }';
        return $this->get_data("getContacts", $params);
    }

    public function getAvatarByKey($pk, $coder = "BASE64", $format = "JPG")
    {
        $params = '{
                "pk": "' . $pk . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
        return $this->get_data("getAvatarByKey", $params);
    }

    public function getContactAvatar($pk, $coder = "BASE64", $format = "JPG")
    {
        $params = '{
                "pk": "' . $pk . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
        return $this->get_data("getContactAvatar", $params);
    }

    public function getChannelAvatar($channelid, $coder = "BASE64", $format = "JPG")
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
        return $this->get_data("getChannelAvatar", $params);
    }

    public function setContactGroup($contactPublicKey, $groupName)
    {
        $params = '{
                "contactPublicKey": "' . $contactPublicKey . '",
                "groupName": "' . $groupName . '"
            }';
        return $this->get_data("setContactGroup", $params);
    }

    public function renameContactGroup($oldGroupName, $newGroupName)
    {
        $params = '{
                "oldGroupName": "' . $oldGroupName . '",
                "newGroupName": "' . $newGroupName . '"
            }';
        return $this->get_data("renameContactGroup", $params);
    }

    public function deleteContactGroup($groupName)
    {
        $params = '{
                "groupName": "' . $groupName . '"
            }';
        return $this->get_data("deleteContactGroup", $params);
    }


    public function setContactNick($contactPublicKey, $newNick)
    {
        $params = '{
                "contactPublicKey": "' . $contactPublicKey . '",
                "newNick": "' . $newNick . '"
            }';
        return $this->get_data("setContactNick", $params);
    }

    public function sendInstantMessage($to, $text)
    {
        $params = '{
                "to": "' . $to . '",
                "text": "' . $text . '"
            }';
        return $this->get_data("sendInstantMessage", $params);
    }

    public function sendInstantQuote($to, $text, $id_message)
    {
        $params = '{
                "to": "' . $to . '",
                "text": "' . $text . '",
                "id_message": "' . $id_message . '"
            }';
        return $this->get_data("sendInstantQuote", $params);
    }

    public function sendInstantSticker($to, $collection, $name)
    {
        $params = '{
                "to": "' . $to . '",
                "collection": "' . $collection . '",
                "name": "' . $name . '"
            }';
        return $this->get_data("sendInstantSticker", $params);
    }

    public function pinInstantMessage($to, $message, $pin)
    {
        $params = '{
                "to": "' . $to . '",
                "message": "' . $message . '",
                "pin": "' . $pin . '"
            }';
        return $this->get_data("pinInstantMessage", $params);
    }

    public function getPinnedMessages($pk)
    {
        $params = '{
                "pk": "' . $pk . '"
            }';
        return $this->get_data("getPinnedMessages", $params);
    }

    public function bookmarkInstantMessage($messageId, $comments)
    {
        $params = '{
                "messageId": "' . $messageId . '",
                "comments": "' . $comments . '"
            }';
        return $this->get_data("bookmarkInstantMessage", $params);
    }

    public function getStickerCollections()
    {
        return $this->get_data("getStickerCollections");
    }

    public function getStickerNamesByCollection($collection_name)
    {
        $params = '{
                "collection_name": "' . $collection_name . '"
            }';
        return $this->get_data("getStickerNamesByCollection", $params);
    }

    public function getImageSticker($collection_name, $sticker_name, $coder = '1')
    {
        $params = '{
                "collection_name": "' . $collection_name . '",
                "sticker_name": "' . $sticker_name . '",
                "coder": "' . $coder . '"
            }';
        return $this->get_data("getImageSticker", $params);
    }

    public function sendInstantBuzz($to, $comments)
    {
        $params = '{
                "to": "' . $to . '",
                "comments": "' . $comments . '"
            }';
        return $this->get_data("sendInstantBuzz", $params);
    }

    public function sendInstantInvitation($to, $channelid, $description, $comments)
    {
        $params = '{
                "to": "' . $to . '",
                "channelid": "' . $channelid . '",
                "description": "' . $description . '",
                "comments": "' . $comments . '"
            }';
        return $this->get_data("sendInstantInvitation", $params);
    }

    public function removeInstantMessages($hex_contact_public_key)
    {
        $params = '{
                "hex_contact_public_key": "' . $hex_contact_public_key . '"
            }';
        return $this->get_data("removeInstantMessages", $params);
    }

    public function getContactMessages($pk)
    {
        $params = '{
                "pk": "' . $pk . '"
            }';
        return $this->get_data("getContactMessages", $params);
    }

    public function sendEmailMessage($to, $subject, $body, $attachmentField)
    {
        $params = '{
                "to": ' . json_encode($to) . ',
                "subject": "' . $subject . '",
                "body": "' . $body . '",
                "attachmentField": ' . json_encode($attachmentField) . '
            }';
        return $this->get_data("sendEmailMessage", $params);
    }

    public function requestNewPublicKeyPaymentAlias()
    {
        return $this->get_data("requestNewPublicKeyPaymentAlias");
    }

    public function getMyPublicKeyPaymentAliases($requestId)
    {
        $params = '{
                "requestId": "' . $requestId . '"
            }';
        return $this->get_data("getMyPublicKeyPaymentAliases", $params);
    }

    public function sendPayment($to, $amount, $comment = "", $cardid = "", $currency = "")
    {
        $params = '{
                "to": "' . $to . '",
                "comment": "' . $comment . '",
                "cardid": "' . $cardid . '",
                "amount": "' . $amount . '",
                "currency": "' . $currency . '"
            }';
        return $this->get_data("sendPayment", $params);
    }
    public function getEmailFolder($folderType, $filter = "")
    {
        $params = '{
                "folderType": "' . $folderType . '",
                "filter": "' . $filter . '"
            }';
        return $this->get_data("getEmailFolder", $params);
    }

    public function getEmails($folderType, $filter = "")
    {
        $params = '{
                "folderType": "' . $folderType . '",
                "filter": "' . $filter . '"
            }';
        return $this->get_data("getEmails", $params);
    }

    public function getEmailById($id)
    {
        $params = '{
                "id": "' . $id . '"
            }';
        return $this->get_data("getEmailById", $params);
    }

    public function acceptAttachment($emailId, $field)
    {
        $params = '{
                "emailId": "' . $emailId . '",
                "field": "' . $field . '"
            }';
        return $this->get_data("acceptAttachment", $params);
    }

    public function abortAttachment($emailId, $field)
    {
        $params = '{
                "emailId": "' . $emailId . '",
                "field": "' . $field . '"
            }';
        return $this->get_data("abortAttachment", $params);
    }

    public function acceptFileMessage($messageId)
    {
        $params = '{
                "messageId": "' . $messageId . '"
            }';
        return $this->get_data("acceptFileMessage", $params);
    }

    public function abortFileMessage($messageId)
    {
        $params = '{
                "messageId": "' . $messageId . '"
            }';
        return $this->get_data("abortFileMessage", $params);
    }

    public function deleteEmail($id)
    {
        $params = '{
                "id": "' . $id . '"
            }';
        return $this->get_data("deleteEmail", $params);
    }

    public function sendReplyEmailMessage($id, $subject, $body, $attachmentField)
    {
        $params = '{
                "id": "' . $id . '",
                "subject": "' . $subject . '",
                "body": "' . $body . '",
                "attachmentField": "' . $attachmentField . '"
            }';
        return $this->get_data("sendReplyEmailMessage", $params);
    }

    public function sendForwardEmailMessage($id, $to, $subject, $body, $attachmentField)
    {
        $params = '{
                "id": "' . $id . '",
                "to": "' . $to . '",
                "subject": "' . $subject . '",
                "body": "' . $body . '",
                "attachmentField": "' . $attachmentField . '"
            }';
        return $this->get_data("sendForwardEmailMessage", $params);
    }

    public function sendEmailInvitation($channelid, $to, $description, $comments)
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "to": ' . json_encode($to) . ',
                "description": "' . $description . '",
                "comments": "' . $comments . '"
            }';
        return $this->get_data("sendEmailInvitation", $params);
    }

    public function emptyEmailsTrash()
    {
        return $this->get_data("emptyEmailsTrash");
    }

    public function getBalance($currency = "CRP")
    {
        $params = '{
                "currency": "' . $currency . '"
            }';
        return $this->get_data("getFinanceSystemInformation", $params);
    }

    public function getFinanceSystemInformation()
    {
        return $this->get_data("getFinanceSystemInformation");
    }

    public function getFinanceHistory($currency = "CRP", $filters = "", $referenceNumber = "", $fromDate = "", $toDate = "", $batchId = "", $fromAmount = "", $toAmount = "", $sourcePk = "", $destinationPk = "")
    {
        $params = '{
                "currency": "' . $currency . '",
                "filters": ' . $filters . ',
                "referenceNumber": "' . $referenceNumber . '",
                "fromDate": "' . $fromDate . '",
                "toDate": "' . $toDate . '",
                "batchId": "' . $batchId . '",
                "fromAmount": "' . $fromAmount . '",
                "toAmount": "' . $toAmount . '",
                "sourcePk": "' . $sourcePk . '",
                "destinationPk": "' . $destinationPk . '"
            }';
        return $this->get_data("getFinanceHistory", $params);
    }

    public function getCards()
    {
        return $this->get_data("getCards");
    }

    public function addCard($name = "", $color = "", $preorderNumberInCard = "")
    {
        $params = '{
                "name": "' . $name . '",
                "color": "' . $color . '",
                "preorderNumberInCard": "' . $preorderNumberInCard . '"
            }';
        return $this->get_data("addCard", $params);
    }

    public function deleteCard($cardId)
    {
        $params = '{
                "cardId": "' . $cardId . '"
            }';
        return $this->get_data("deleteCard", $params);
    }

    public function enablePoS($enable)
    {
        $params = '{
                "enable": ' . $enable . '
            }';
        return $this->get_data("enablePoS", $params);
    }
    public function enableHistoryMining($enable)
    {
        $params = '{
                "enable": ' . $enable . '
            }';
        return $this->get_data("enableHistoryMining", $params);
    }

    public function statusHistoryMining()
    {
        return $this->get_data("statusHistoryMining");
    }

    public function getMiningBlocks()
    {
        return $this->get_data("getMiningBlocks");
    }

    public function getMiningInfo()
    {
        return $this->get_data("getMiningInfo");
    }

    public function getVouchers($currency = "CRP")
    {
        $params = '{
                "currency": "' . $currency . '"
            }';
        return $this->get_data("getVouchers", $params);
    }

    public function createVoucher($amount, $currency = "CRP")
    {
        $params = '{
                "amount": "' . $amount . '",
                "currency": "' . $currency . '"
            }';
        return $this->get_data("createVoucher", $params);
    }

    public function createVoucherBatch($amount, $count, $currency = "CRP")
    {
        $params = '{
                "amount": "' . $amount . '",
                "count": "' . $count . '",
                "currency": "' . $currency . '"
            }';
        return $this->get_data("createVoucherBatch", $params);
    }

    public function useVoucher($voucherid)
    {
        $params = '{
                "voucherid": "' . $voucherid . '"
            }';
        return $this->get_data("useVoucher", $params);
    }

    public function deleteVoucher($voucherid)
    {
        $params = '{
                "voucherid": "' . $voucherid . '"
            }';
        return $this->get_data("deleteVoucher", $params);
    }

    public function getInvoices($cardId = "", $invoiceId = "", $pk = "", $transactionId = "", $status = "", $startDateTime = "", $endDateTime = "", $referenceNumber = "")
    {
        $params = '{
                "cardId": "' . $cardId . '",
                "invoiceId": "' . $invoiceId . '",
                "pk": "' . $pk . '",
                "transactionId": "' . $transactionId . '",
                "status": "' . $status . '",
                "startDateTime": "' . $startDateTime . '",
                "endDateTime": "' . $endDateTime . '",
                "referenceNumber": "' . $referenceNumber . '"
            }';
        return $this->get_data("getInvoices", $params);
    }

    public function getInvoiceByReferenceNumber($referenceNumber)
    {
        $params = '{
                "referenceNumber": "' . $referenceNumber . '"
            }';
        return $this->get_data("getInvoiceByReferenceNumber", $params);
    }

    public function getTransactionIdByReferenceNumber($referenceNumber)
    {
        $params = '{
                "referenceNumber": "' . $referenceNumber . '"
            }';
        return $this->get_data("getTransactionIdByReferenceNumber", $params);
    }

    public function sendInvoice($cardId, $amount, $comment = "")
    {
        $params = '{
                "cardId": "' . $cardId . '",
                "comment": "' . $comment . '",
                "amount": "' . $amount . '"
            }';
        return $this->get_data("sendInvoice", $params);
    }

    public function acceptInvoice($invoiceId)
    {
        $params = '{
                "invoiceId": "' . $invoiceId . '"
            }';
        return $this->get_data("acceptInvoice", $params);
    }

    public function declineInvoice($invoiceId)
    {
        $params = '{
                "invoiceId": "' . $invoiceId . '"
            }';
        return $this->get_data("declineInvoice", $params);
    }
    public function cancelInvoice($invoiceId)
    {
        $params = '{
                "invoiceId": "' . $invoiceId . '"
            }';
        return $this->get_data("cancelInvoice", $params);
    }

    public function requestUnsTransfer($name, $hexNewOwnerPk)
    {
        $params = '{
                "name": "' . $name . '",
                "hexNewOwnerPk": "' . $hexNewOwnerPk . '"
            }';
        return $this->get_data("requestUnsTransfer", $params);
    }

    public function acceptUnsTransfer($requestId)
    {
        $params = '{
                "requestId": "' . $requestId . '"
            }';
        return $this->get_data("acceptUnsTransfer", $params);
    }

    public function declineUnsTransfer($requestId)
    {
        $params = '{
                "requestId": "' . $requestId . '"
            }';
        return $this->get_data("declineUnsTransfer", $params);
    }

    public function incomingUnsTransfer()
    {
        return $this->get_data("incomingUnsTransfer");
    }
    public function requestAllFinnaceHistory()
    {
        return $this->get_data("requestAllFinnaceHistory");
    }
    public function outgoingUnsTransfer()
    {
        return $this->get_data("outgoingUnsTransfer");
    }
    public function storageWipe()
    {
        return $this->get_data("storageWipe");
    }

    public function sendAuthorizationRequest($pk, $message)
    {
        $params = '{
                "pk": "' . $pk . '",
                "message": "' . $message . '"
            }';
        return $this->get_data("sendAuthorizationRequest", $params);
    }

    public function acceptAuthorizationRequest($pk, $message)
    {
        $params = '{
                "pk": "' . $pk . '",
                "message": "' . $message . '"
            }';
        return $this->get_data("acceptAuthorizationRequest", $params);
    }

    public function rejectAuthorizationRequest($pk, $message)
    {
        $params = '{
                "pk": "' . $pk . '",
                "message": "' . $message . '"
            }';
        return $this->get_data("rejectAuthorizationRequest", $params);
    }
    public function deleteContact($pk)
    {
        $params = '{
                "pk": "' . $pk . '"
            }';
        return $this->get_data("deleteContact", $params);
    }
    public function getChannels()
    {
        return $this->get_data("getChannels");
    }
    public function sendChannelMessage($channelid, $message)
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "message": "' . $message . '"
            }';
        return $this->get_data("sendChannelMessage", $params);
    }
    public function sendChannelPicture($channelid, $base64_image, $comment = "", $filename_image = "")
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "base64_image": "' . $base64_image . '",
                "comment": "' . $comment . '",
                "filename_image": "' . $filename_image . '"
            }';
        return $this->get_data("sendChannelPicture", $params);
    }

    public function sendChannelQuote($channelid, $text, $id_message)
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "text": "' . $text . '",
                "id_message": "' . $id_message . '"
            }';
        return $this->get_data("sendChannelQuote", $params);
    }
    public function removeChannelMessage($channelid, $id_message)
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "id_message": "' . $id_message . '"
            }';
        return $this->get_data("removeChannelMessage", $params);
    }
    public function enableChannelNotification($channelid, $enable)
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "enable": "' . $enable . '"
            }';
        return $this->get_data("enableChannelNotification", $params);
    }

    public function joinChannel($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("joinChannel", $params);
    }
    public function fetchChannelHistory($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("fetchChannelHistory", $params);
    }
    public function leaveChannel($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("leaveChannel", $params);
    }
    public function setChannelAsBookmarked($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("setChannelAsBookmarked", $params);
    }
    public function getChannelMessages($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("getChannelMessages", $params);
    }
    public function getChannelInfo($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("getChannelInfo", $params);
    }
    public function getChannelModerators($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("getChannelModerators", $params);
    }
    public function getChannelContacts($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("getChannelContacts", $params);
    }
    public function getChannelModeratorRight($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("getChannelModeratorRight", $params);
    }

    public function createChannel($channel_name, $description, $read_only = "", $read_only_privacy = "", $password = "", $languages = "", $hashtags = "", $base64_avatar_image = "", $hide_in_UI = "")
    {
        $params = '{
                "channel_name": "' . $channel_name . '",
                "description": "' . $description . '",
                "read_only": "' . $read_only . '",
                "read_only_privacy": "' . $read_only_privacy . '",
                "password": "' . $password . '",
                "languages": "' . $languages . '",
                "hashtags": "' . $hashtags . '",
                "base64_avatar_image": "' . $base64_avatar_image . '",
                "hide_in_UI": "' . $hide_in_UI . '"
            }';
        return $this->get_data("createChannel", $params);
    }


    public function modifyChannel($channel_name, $description, $read_only = "", $read_only_privacy = "", $password = "", $languages = "", $hashtags = "", $base64_avatar_image = "", $hide_in_UI = "")
    {
        $params = '{
                "channel_name": "' . $channel_name . '",
                "description": "' . $description . '",
                "read_only": "' . $read_only . '",
                "read_only_privacy": "' . $read_only_privacy . '",
                "password": "' . $password . '",
                "languages": "' . $languages . '",
                "hashtags": "' . $hashtags . '",
                "base64_avatar_image": "' . $base64_avatar_image . '",
                "hide_in_UI": "' . $hide_in_UI . '"
            }';
        return $this->get_data("modifyChannel", $params);
    }


    public function deleteChannel($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("deleteChannel", $params);
    }

    public function getChannelSystemInfo()
    {
        return $this->get_data("getChannelSystemInfo", "");
    }

    public function getChannelBannedContacts($channelid)
    {
        $params = '{
                "channelid": "' . $channelid . '"
            }';
        return $this->get_data("getChannelBannedContacts", $params);
    }

    public function sendChannelPrivateMessageToContact($channelid, $contactHashedPk, $message)
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "contactHashedPk": "' . $contactHashedPk . '",
                "message": "' . $message . '"
            }';
        return $this->get_data("sendChannelPrivateMessageToContact", $params);
    }
    public function getChannelPrivateMessagesOfContact($channelid, $contactHashedPk)
    {
        $params = '{
                "channelid": "' . $channelid . '",
                "contactHashedPk": "' . $contactHashedPk . '"
            }';
        return $this->get_data("getChannelPrivateMessagesOfContact", $params);
    }

    public function unsCreateRecordRequest($nick, $isPrimary = "false", $channelId = "")
    {
        $params = '{
                "nick": "' . $nick . '",
                "isPrimary": "' . $isPrimary . '",
                "channelId": "' . $channelId . '"
            }';
        return $this->get_data("unsCreateRecordRequest", $params);
    }

    public function unsModifyRecordRequest($nick, $valid = "", $isPrimary = "", $channelId = "")
    {
        $params = '{
                "nick": "' . $nick . '",
                "valid": "' . $valid . '",
                "isPrimary": "' . $isPrimary . '",
                "channelId": "' . $channelId . '"
            }';
        return $this->get_data("unsModifyRecordRequest", $params);
    }

    public function unsDeleteRecordRequest($nick)
    {
        $params = '{
                "nick": "' . $nick . '"
            }';
        return $this->get_data("unsDeleteRecordRequest", $params);
    }

    public function unsSearchByPk($pk)
    {
        $params = '{
                "pk": "' . $pk . '"
            }';
        return $this->get_data("unsSearchByPk", $params);
    }

    public function unsSearchByNick($nick)
    {
        $params = '{
                "nick": "' . $nick . '"
            }';
        return $this->get_data("unsSearchByNick", $params);
    }


    public function getUnsSyncInfo()
    {
        return $this->get_data("getUnsSyncInfo", "");
    }
    public function unsRegisteredNames()
    {
        return $this->get_data("unsRegisteredNames", "");
    }
    public function summaryUnsRegisteredNames($fromDate = "", $toDate = "")
    {
        $params = '{
                "fromDate": "' . $fromDate . '",
                "toDate": "' . $toDate . '"
            }';
        return $this->get_data("summaryUnsRegisteredNames", $params);
    }


    public function getNetworkConnections()
    {
        return $this->get_data("getNetworkConnections", "");
    }
    public function enableLogs($enabled)
    {
        $params = '{
                "enabled": "' . $enabled . '"
            }';
        return $this->get_data("enableLogs", $params);
    }
    public function getLogs()
    {
    }

    public function getProxyMappings()
    {
        return $this->get_data("getProxyMappings", "");
    }

    public function createProxyMapping($srcHost, $srcPort, $dstHost, $dstPort, $enabled)
    {
        $params = '{
                "srcHost": "' . $srcHost . '",
                "srcPort": "' . $srcPort . '",
                "dstHost": "' . $dstHost . '",
                "dstPort": "' . $dstPort . '",
                "enabled": "' . $enabled . '"
            }';
        return $this->get_data("createProxyMapping", $params);
    }

    public function enableProxyMapping($mappingId)
    {
        $params = '{
                "mappingId": "' . $mappingId . '"
            }';
        return $this->get_data("enableProxyMapping", $params);
    }
    public function disableProxyMapping($mappingId)
    {
        $params = '{
                "mappingId": "' . $mappingId . '"
            }';
        return $this->get_data("disableProxyMapping", $params);
    }
    public function removeProxyMapping($mappingId)
    {
        $params = '{
                "mappingId": "' . $mappingId . '"
            }';
        return $this->get_data("removeProxyMapping", $params);
    }
    public function lowTrafficMode()
    {
        return $this->get_data("lowTrafficMode", "");
    }
    public function setLowTrafficMode($enabled)
    {
        $params = '{
                "enable": "' . $enabled . '"
            }';
        return $this->get_data("setLowTrafficMode", $params);
    }

    public function getWhoIsInfo()
    {
        return $this->get_data("getWhoIsInfo", "");
    }
    public function requestTreasuryPoSRates()
    {
        return $this->get_data("requestTreasuryPoSRates", "");
    }
    public function getTreasuryPoSRates()
    {
        return $this->get_data("getTreasuryPoSRates", "");
    }
    public function requestTreasuryTransactionVolumes()
    {
        return $this->get_data("requestTreasuryTransactionVolumes", "");
    }
    public function getTreasuryTransactionVolumes()
    {
        return $this->get_data("getTreasuryTransactionVolumes", "");
    }
    public function requestTreasuryUUSDSupply()
    {
        return $this->get_data("requestTreasuryUUSDSupply", "");
    }
    public function getTreasuryUUSDSupply()
    {
        return $this->get_data("getTreasuryUUSDSupply", "");
    }
    public function requestTreasuryCrpSupply()
    {
        return $this->get_data("requestTreasuryCrpSupply", "");
    }
    public function getTreasuryCrpSupply()
    {
        return $this->get_data("getTreasuryCrpSupply", "");
    }
    public function ucodeEncode($hex_code, $size_image, $coder = "BASE64", $format = "JPG")
    {
        $params = '{
                "hex_code": "' . $hex_code . '",
                "size_image": "' . $size_image . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
        return $this->get_data("ucodeEncode", $params);
    }
    public function ucodeDecode($base64_image)
    {
        $params = '{
                "base64_image": "' . $base64_image . '"
            }';
        return $this->get_data("ucodeDecode", $params);
    }

    public function getTransfersFromManager()
    {
        return $this->get_data("getTransfersFromManager", "");
    }
    public function getFilesFromManager()
    {
        return $this->get_data("getFilesFromManager", "");
    }
    public function abortTransfers($transferId)
    {
        $params = '{
                "transferId": "' . $transferId . '"
            }';
        return $this->get_data("abortTransfers", $params);
    }
    public function hideTransfers($transferId)
    {
        $params = '{
                "transferId": "' . $transferId . '"
            }';
        return $this->get_data("hideTransfers", $params);
    }
    public function getFile($fileId)
    {
        $params = '{
                "fileId": "' . $fileId . '"
            }';
        return $this->get_data("getFile", $params);
    }
    public function deleteFile($fileId)
    {
        $params = '{
                "fileId": "' . $fileId . '"
            }';
        return $this->get_data("deleteFile", $params);
    }
    public function sendFileByMessage($to, $fileId)
    {
        $params = '{
                "to": "' . $to . '",
                "fileId": "' . $fileId . '"
            }';
        return $this->get_data("sendFileByMessage", $params);
    }
    public function uploadFile($fileDataBase64, $fileName = "")
    {
        $params = '{
                "fileDataBase64": "' . $fileDataBase64 . '",
                "fileName": "' . $fileName . '"
            }';
        return $this->get_data("uploadFile", $params);
    }
}