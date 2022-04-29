<?php

namespace src;


class call
{
    public function __call($name, $arg)
    {
        return call_user_func($name, $arg);
    }
}


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



    public function call()
    {
        // make token visible for all functions
        // global $config;
        global $token;
        global $ip;
        $token = $this->config['token'];
        $ip = $this->config['ip'];


        function get_data($method, $params = "", $offset = "")
        {
            global $token;
            global $ip;

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

        function getSystemInfo()
        {
            return get_data("getSystemInfo");
        }

        function getProfileStatus()
        {
            return $this->get_data("getProfileStatus");
        }

        function setProfileStatus($status, $mood)
        {
            $params = '{
                "status": "' . $status . '",
                "mood": "' . $mood . '"
            }';
            return $this->get_data("setProfileStatus", $params);
        }

        function getReleaseNotes()
        {
            return $this->get_data("getReleaseNotes");
        }

        function getSettingInfo($settingId)
        {
            $params = '{
                "settingId": "' . $settingId . '"
            }';
            return $this->get_data("getSettingInfo");
        }

        function setSettingInfo($settingId, $newValue)
        {
            $params = '{
                "settingId": "' . $settingId . '",
                "newValue": "' . $newValue . '"
            }';
            return $this->get_data("setSettingInfo", $params);
        }

        function getOwnContact()
        {
            return $this->get_data("getOwnContact");
        }

        function setProfileData($nick = "", $firstName = "", $lastName = "")
        {
            $params = '{
                "nick": "' . $nick . '",
                "firstName": "' . $firstName . '",
                "lastName": "' . $lastName . '"
            }';
            return $this->get_data("setProfileData", $params);
        }

        function getContactGroups()
        {
            return $this->get_data("getContactGroups");
        }
        function getContactsByGroup($groupName)
        {
            $params = '{
                "groupName": "' . $groupName . '"
            }';
            return $this->get_data("getContactsByGroup", $params);
        }

        function getContacts($filter = "")
        {
            $params = '{
                "filter": "' . $filter . '"
            }';
            return $this->get_data("getContacts", $params);
        }

        function getAvatarByKey($pk, $coder = "BASE64", $format = "JPG")
        {
            $params = '{
                "pk": "' . $pk . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
            return $this->get_data("getAvatarByKey", $params);
        }

        function getContactAvatar($pk, $coder = "BASE64", $format = "JPG")
        {
            $params = '{
                "pk": "' . $pk . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
            return $this->get_data("getContactAvatar", $params);
        }

        function getChannelAvatar($channelid, $coder = "BASE64", $format = "JPG")
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
            return $this->get_data("getChannelAvatar", $params);
        }

        function setContactGroup($contactPublicKey, $groupName)
        {
            $params = '{
                "contactPublicKey": "' . $contactPublicKey . '",
                "groupName": "' . $groupName . '"
            }';
            return $this->get_data("setContactGroup", $params);
        }

        function renameContactGroup($oldGroupName, $newGroupName)
        {
            $params = '{
                "oldGroupName": "' . $oldGroupName . '",
                "newGroupName": "' . $newGroupName . '"
            }';
            return $this->get_data("renameContactGroup", $params);
        }

        function deleteContactGroup($groupName)
        {
            $params = '{
                "groupName": "' . $groupName . '"
            }';
            return $this->get_data("deleteContactGroup", $params);
        }


        function setContactNick($contactPublicKey, $newNick)
        {
            $params = '{
                "contactPublicKey": "' . $contactPublicKey . '",
                "newNick": "' . $newNick . '"
            }';
            return $this->get_data("setContactNick", $params);
        }

        function sendInstantMessage($to, $text)
        {
            $params = '{
                "to": "' . $to . '",
                "text": "' . $text . '"
            }';
            return $this->get_data("sendInstantMessage", $params);
        }

        function sendInstantQuote($to, $text, $id_message)
        {
            $params = '{
                "to": "' . $to . '",
                "text": "' . $text . '",
                "id_message": "' . $id_message . '"
            }';
            return $this->get_data("sendInstantQuote", $params);
        }

        function sendInstantSticker($to, $collection, $name)
        {
            $params = '{
                "to": "' . $to . '",
                "collection": "' . $collection . '",
                "name": "' . $name . '"
            }';
            return $this->get_data("sendInstantSticker", $params);
        }

        function pinInstantMessage($to, $message, $pin)
        {
            $params = '{
                "to": "' . $to . '",
                "message": "' . $message . '",
                "pin": "' . $pin . '"
            }';
            return $this->get_data("pinInstantMessage", $params);
        }

        function getPinnedMessages($pk)
        {
            $params = '{
                "pk": "' . $pk . '"
            }';
            return $this->get_data("getPinnedMessages", $params);
        }

        function bookmarkInstantMessage($messageId, $comments)
        {
            $params = '{
                "messageId": "' . $messageId . '",
                "comments": "' . $comments . '"
            }';
            return $this->get_data("bookmarkInstantMessage", $params);
        }

        function getStickerCollections()
        {
            return $this->get_data("getStickerCollections");
        }

        function getStickerNamesByCollection($collection_name)
        {
            $params = '{
                "collection_name": "' . $collection_name . '"
            }';
            return $this->get_data("getStickerNamesByCollection", $params);
        }

        function getImageSticker($collection_name, $sticker_name, $coder = '1')
        {
            $params = '{
                "collection_name": "' . $collection_name . '",
                "sticker_name": "' . $sticker_name . '",
                "coder": "' . $coder . '"
            }';
            return $this->get_data("getImageSticker", $params);
        }

        function sendInstantBuzz($to, $comments)
        {
            $params = '{
                "to": "' . $to . '",
                "comments": "' . $comments . '"
            }';
            return $this->get_data("sendInstantBuzz", $params);
        }

        function sendInstantInvitation($to, $channelid, $description, $comments)
        {
            $params = '{
                "to": "' . $to . '",
                "channelid": "' . $channelid . '",
                "description": "' . $description . '",
                "comments": "' . $comments . '"
            }';
            return $this->get_data("sendInstantInvitation", $params);
        }

        function removeInstantMessages($hex_contact_public_key)
        {
            $params = '{
                "hex_contact_public_key": "' . $hex_contact_public_key . '"
            }';
            return $this->get_data("removeInstantMessages", $params);
        }

        function getContactMessages($pk)
        {
            $params = '{
                "pk": "' . $pk . '"
            }';
            return $this->get_data("getContactMessages", $params);
        }

        function sendEmailMessage($to, $subject, $body, $attachmentField)
        {
            $params = '{
                "to": ' . json_encode($to) . ',
                "subject": "' . $subject . '",
                "body": "' . $body . '",
                "attachmentField": ' . json_encode($attachmentField) . '
            }';
            return $this->get_data("sendEmailMessage", $params);
        }

        function requestNewPublicKeyPaymentAlias()
        {
            return $this->get_data("requestNewPublicKeyPaymentAlias");
        }

        function getMyPublicKeyPaymentAliases($requestId)
        {
            $params = '{
                "requestId": "' . $requestId . '"
            }';
            return $this->get_data("getMyPublicKeyPaymentAliases", $params);
        }

        function sendPayment($to, $amount, $comment = "", $cardid = "", $currency = "")
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
        function getEmailFolder($folderType, $filter = "")
        {
            $params = '{
                "folderType": "' . $folderType . '",
                "filter": "' . $filter . '"
            }';
            return $this->get_data("getEmailFolder", $params);
        }

        function getEmails($folderType, $filter = "")
        {
            $params = '{
                "folderType": "' . $folderType . '",
                "filter": "' . $filter . '"
            }';
            return $this->get_data("getEmails", $params);
        }

        function getEmailById($id)
        {
            $params = '{
                "id": "' . $id . '"
            }';
            return $this->get_data("getEmailById", $params);
        }

        function acceptAttachment($emailId, $field)
        {
            $params = '{
                "emailId": "' . $emailId . '",
                "field": "' . $field . '"
            }';
            return $this->get_data("acceptAttachment", $params);
        }

        function abortAttachment($emailId, $field)
        {
            $params = '{
                "emailId": "' . $emailId . '",
                "field": "' . $field . '"
            }';
            return $this->get_data("abortAttachment", $params);
        }

        function acceptFileMessage($messageId)
        {
            $params = '{
                "messageId": "' . $messageId . '"
            }';
            return $this->get_data("acceptFileMessage", $params);
        }

        function abortFileMessage($messageId)
        {
            $params = '{
                "messageId": "' . $messageId . '"
            }';
            return $this->get_data("abortFileMessage", $params);
        }

        function deleteEmail($id)
        {
            $params = '{
                "id": "' . $id . '"
            }';
            return $this->get_data("deleteEmail", $params);
        }

        function sendReplyEmailMessage($id, $subject, $body, $attachmentField)
        {
            $params = '{
                "id": "' . $id . '",
                "subject": "' . $subject . '",
                "body": "' . $body . '",
                "attachmentField": "' . $attachmentField . '"
            }';
            return $this->get_data("sendReplyEmailMessage", $params);
        }

        function sendForwardEmailMessage($id, $to, $subject, $body, $attachmentField)
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

        function sendEmailInvitation($channelid, $to, $description, $comments)
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "to": ' . json_encode($to) . ',
                "description": "' . $description . '",
                "comments": "' . $comments . '"
            }';
            return $this->get_data("sendEmailInvitation", $params);
        }

        function emptyEmailsTrash()
        {
            return $this->get_data("emptyEmailsTrash");
        }

        function getBalance($currency = "CRP")
        {
            $params = '{
                "currency": "' . $currency . '"
            }';
            return $this->get_data("getFinanceSystemInformation", $params);
        }

        function getFinanceSystemInformation()
        {
            return $this->get_data("getFinanceSystemInformation");
        }

        function getFinanceHistory($currency = "CRP", $filters = "", $referenceNumber = "", $fromDate = "", $toDate = "", $batchId = "", $fromAmount = "", $toAmount = "", $sourcePk = "", $destinationPk = "")
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

        function getCards()
        {
            return $this->get_data("getCards");
        }

        function addCard($name = "", $color = "", $preorderNumberInCard = "")
        {
            $params = '{
                "name": "' . $name . '",
                "color": "' . $color . '",
                "preorderNumberInCard": "' . $preorderNumberInCard . '"
            }';
            return $this->get_data("addCard", $params);
        }

        function deleteCard($cardId)
        {
            $params = '{
                "cardId": "' . $cardId . '"
            }';
            return $this->get_data("deleteCard", $params);
        }

        function enablePoS($enable)
        {
            $params = '{
                "enable": ' . $enable . '
            }';
            return $this->get_data("enablePoS", $params);
        }
        function enableHistoryMining($enable)
        {
            $params = '{
                "enable": ' . $enable . '
            }';
            return $this->get_data("enableHistoryMining", $params);
        }

        function statusHistoryMining()
        {
            return $this->get_data("statusHistoryMining");
        }

        function getMiningBlocks()
        {
            return $this->get_data("getMiningBlocks");
        }

        function getMiningInfo()
        {
            return $this->get_data("getMiningInfo");
        }

        function getVouchers($currency = "CRP")
        {
            $params = '{
                "currency": "' . $currency . '"
            }';
            return $this->get_data("getVouchers", $params);
        }

        function createVoucher($amount, $currency = "CRP")
        {
            $params = '{
                "amount": "' . $amount . '",
                "currency": "' . $currency . '"
            }';
            return $this->get_data("createVoucher", $params);
        }

        function createVoucherBatch($amount, $count, $currency = "CRP")
        {
            $params = '{
                "amount": "' . $amount . '",
                "count": "' . $count . '",
                "currency": "' . $currency . '"
            }';
            return $this->get_data("createVoucherBatch", $params);
        }

        function useVoucher($voucherid)
        {
            $params = '{
                "voucherid": "' . $voucherid . '"
            }';
            return $this->get_data("useVoucher", $params);
        }

        function deleteVoucher($voucherid)
        {
            $params = '{
                "voucherid": "' . $voucherid . '"
            }';
            return $this->get_data("deleteVoucher", $params);
        }

        function getInvoices($cardId = "", $invoiceId = "", $pk = "", $transactionId = "", $status = "", $startDateTime = "", $endDateTime = "", $referenceNumber = "")
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

        function getInvoiceByReferenceNumber($referenceNumber)
        {
            $params = '{
                "referenceNumber": "' . $referenceNumber . '"
            }';
            return $this->get_data("getInvoiceByReferenceNumber", $params);
        }

        function getTransactionIdByReferenceNumber($referenceNumber)
        {
            $params = '{
                "referenceNumber": "' . $referenceNumber . '"
            }';
            return $this->get_data("getTransactionIdByReferenceNumber", $params);
        }

        function sendInvoice($cardId, $amount, $comment = "")
        {
            $params = '{
                "cardId": "' . $cardId . '",
                "comment": "' . $comment . '",
                "amount": "' . $amount . '"
            }';
            return $this->get_data("sendInvoice", $params);
        }

        function acceptInvoice($invoiceId)
        {
            $params = '{
                "invoiceId": "' . $invoiceId . '"
            }';
            return $this->get_data("acceptInvoice", $params);
        }

        function declineInvoice($invoiceId)
        {
            $params = '{
                "invoiceId": "' . $invoiceId . '"
            }';
            return $this->get_data("declineInvoice", $params);
        }
        function cancelInvoice($invoiceId)
        {
            $params = '{
                "invoiceId": "' . $invoiceId . '"
            }';
            return $this->get_data("cancelInvoice", $params);
        }

        function requestUnsTransfer($name, $hexNewOwnerPk)
        {
            $params = '{
                "name": "' . $name . '",
                "hexNewOwnerPk": "' . $hexNewOwnerPk . '"
            }';
            return $this->get_data("requestUnsTransfer", $params);
        }

        function acceptUnsTransfer($requestId)
        {
            $params = '{
                "requestId": "' . $requestId . '"
            }';
            return $this->get_data("acceptUnsTransfer", $params);
        }

        function declineUnsTransfer($requestId)
        {
            $params = '{
                "requestId": "' . $requestId . '"
            }';
            return $this->get_data("declineUnsTransfer", $params);
        }

        function incomingUnsTransfer()
        {
            return $this->get_data("incomingUnsTransfer");
        }
        function requestAllFinnaceHistory()
        {
            return $this->get_data("requestAllFinnaceHistory");
        }
        function outgoingUnsTransfer()
        {
            return $this->get_data("outgoingUnsTransfer");
        }
        function storageWipe()
        {
            return $this->get_data("storageWipe");
        }

        function sendAuthorizationRequest($pk, $message)
        {
            $params = '{
                "pk": "' . $pk . '",
                "message": "' . $message . '"
            }';
            return $this->get_data("sendAuthorizationRequest", $params);
        }

        function acceptAuthorizationRequest($pk, $message)
        {
            $params = '{
                "pk": "' . $pk . '",
                "message": "' . $message . '"
            }';
            return $this->get_data("acceptAuthorizationRequest", $params);
        }

        function rejectAuthorizationRequest($pk, $message)
        {
            $params = '{
                "pk": "' . $pk . '",
                "message": "' . $message . '"
            }';
            return $this->get_data("rejectAuthorizationRequest", $params);
        }
        function deleteContact($pk)
        {
            $params = '{
                "pk": "' . $pk . '"
            }';
            return $this->get_data("deleteContact", $params);
        }
        function getChannels()
        {
            return $this->get_data("getChannels");
        }
        function sendChannelMessage($channelid, $message)
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "message": "' . $message . '"
            }';
            return $this->get_data("sendChannelMessage", $params);
        }
        function sendChannelPicture($channelid, $base64_image, $comment = "", $filename_image = "")
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "base64_image": "' . $base64_image . '",
                "comment": "' . $comment . '",
                "filename_image": "' . $filename_image . '"
            }';
            return $this->get_data("sendChannelPicture", $params);
        }

        function sendChannelQuote($channelid, $text, $id_message)
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "text": "' . $text . '",
                "id_message": "' . $id_message . '"
            }';
            return $this->get_data("sendChannelQuote", $params);
        }
        function removeChannelMessage($channelid, $id_message)
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "id_message": "' . $id_message . '"
            }';
            return $this->get_data("removeChannelMessage", $params);
        }
        function enableChannelNotification($channelid, $enable)
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "enable": "' . $enable . '"
            }';
            return $this->get_data("enableChannelNotification", $params);
        }

        function joinChannel($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("joinChannel", $params);
        }
        function fetchChannelHistory($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("fetchChannelHistory", $params);
        }
        function leaveChannel($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("leaveChannel", $params);
        }
        function setChannelAsBookmarked($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("setChannelAsBookmarked", $params);
        }
        function getChannelMessages($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("getChannelMessages", $params);
        }
        function getChannelInfo($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("getChannelInfo", $params);
        }
        function getChannelModerators($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("getChannelModerators", $params);
        }
        function getChannelContacts($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("getChannelContacts", $params);
        }
        function getChannelModeratorRight($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("getChannelModeratorRight", $params);
        }

        function createChannel($channel_name, $description, $read_only = "", $read_only_privacy = "", $password = "", $languages = "", $hashtags = "", $base64_avatar_image = "", $hide_in_UI = "")
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


        function modifyChannel($channel_name, $description, $read_only = "", $read_only_privacy = "", $password = "", $languages = "", $hashtags = "", $base64_avatar_image = "", $hide_in_UI = "")
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


        function deleteChannel($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("deleteChannel", $params);
        }

        function getChannelSystemInfo()
        {
            return $this->get_data("getChannelSystemInfo", "");
        }

        function getChannelBannedContacts($channelid)
        {
            $params = '{
                "channelid": "' . $channelid . '"
            }';
            return $this->get_data("getChannelBannedContacts", $params);
        }

        function sendChannelPrivateMessageToContact($channelid, $contactHashedPk, $message)
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "contactHashedPk": "' . $contactHashedPk . '",
                "message": "' . $message . '"
            }';
            return $this->get_data("sendChannelPrivateMessageToContact", $params);
        }
        function getChannelPrivateMessagesOfContact($channelid, $contactHashedPk)
        {
            $params = '{
                "channelid": "' . $channelid . '",
                "contactHashedPk": "' . $contactHashedPk . '"
            }';
            return $this->get_data("getChannelPrivateMessagesOfContact", $params);
        }

        function unsCreateRecordRequest($nick, $isPrimary = "false", $channelId = "")
        {
            $params = '{
                "nick": "' . $nick . '",
                "isPrimary": "' . $isPrimary . '",
                "channelId": "' . $channelId . '"
            }';
            return $this->get_data("unsCreateRecordRequest", $params);
        }

        function unsModifyRecordRequest($nick, $valid = "", $isPrimary = "", $channelId = "")
        {
            $params = '{
                "nick": "' . $nick . '",
                "valid": "' . $valid . '",
                "isPrimary": "' . $isPrimary . '",
                "channelId": "' . $channelId . '"
            }';
            return $this->get_data("unsModifyRecordRequest", $params);
        }

        function unsDeleteRecordRequest($nick)
        {
            $params = '{
                "nick": "' . $nick . '"
            }';
            return $this->get_data("unsDeleteRecordRequest", $params);
        }

        function unsSearchByPk($pk)
        {
            $params = '{
                "pk": "' . $pk . '"
            }';
            return $this->get_data("unsSearchByPk", $params);
        }

        function unsSearchByNick($nick)
        {
            $params = '{
                "nick": "' . $nick . '"
            }';
            return $this->get_data("unsSearchByNick", $params);
        }


        function getUnsSyncInfo()
        {
            return $this->get_data("getUnsSyncInfo", "");
        }
        function unsRegisteredNames()
        {
            return $this->get_data("unsRegisteredNames", "");
        }
        function summaryUnsRegisteredNames($fromDate = "", $toDate = "")
        {
            $params = '{
                "fromDate": "' . $fromDate . '",
                "toDate": "' . $toDate . '"
            }';
            return $this->get_data("summaryUnsRegisteredNames", $params);
        }


        function getNetworkConnections()
        {
            return $this->get_data("getNetworkConnections", "");
        }
        function enableLogs($enabled)
        {
            $params = '{
                "enabled": "' . $enabled . '"
            }';
            return $this->get_data("enableLogs", $params);
        }
        function getLogs()
        {
        }

        function getProxyMappings()
        {
            return $this->get_data("getProxyMappings", "");
        }

        function createProxyMapping($srcHost, $srcPort, $dstHost, $dstPort, $enabled)
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

        function enableProxyMapping($mappingId)
        {
            $params = '{
                "mappingId": "' . $mappingId . '"
            }';
            return $this->get_data("enableProxyMapping", $params);
        }
        function disableProxyMapping($mappingId)
        {
            $params = '{
                "mappingId": "' . $mappingId . '"
            }';
            return $this->get_data("disableProxyMapping", $params);
        }
        function removeProxyMapping($mappingId)
        {
            $params = '{
                "mappingId": "' . $mappingId . '"
            }';
            return $this->get_data("removeProxyMapping", $params);
        }
        function lowTrafficMode()
        {
            return $this->get_data("lowTrafficMode", "");
        }
        function setLowTrafficMode($enabled)
        {
            $params = '{
                "enable": "' . $enabled . '"
            }';
            return $this->get_data("setLowTrafficMode", $params);
        }

        function getWhoIsInfo()
        {
            return $this->get_data("getWhoIsInfo", "");
        }
        function requestTreasuryPoSRates()
        {
            return $this->get_data("requestTreasuryPoSRates", "");
        }
        function getTreasuryPoSRates()
        {
            return $this->get_data("getTreasuryPoSRates", "");
        }
        function requestTreasuryTransactionVolumes()
        {
            return $this->get_data("requestTreasuryTransactionVolumes", "");
        }
        function getTreasuryTransactionVolumes()
        {
            return $this->get_data("getTreasuryTransactionVolumes", "");
        }
        function requestTreasuryUUSDSupply()
        {
            return $this->get_data("requestTreasuryUUSDSupply", "");
        }
        function getTreasuryUUSDSupply()
        {
            return $this->get_data("getTreasuryUUSDSupply", "");
        }
        function requestTreasuryCrpSupply()
        {
            return $this->get_data("requestTreasuryCrpSupply", "");
        }
        function getTreasuryCrpSupply()
        {
            return $this->get_data("getTreasuryCrpSupply", "");
        }
        function ucodeEncode($hex_code, $size_image, $coder = "BASE64", $format = "JPG")
        {
            $params = '{
                "hex_code": "' . $hex_code . '",
                "size_image": "' . $size_image . '",
                "coder": "' . $coder . '",
                "format": "' . $format . '"
            }';
            return $this->get_data("ucodeEncode", $params);
        }
        function ucodeDecode($base64_image)
        {
            $params = '{
                "base64_image": "' . $base64_image . '"
            }';
            return $this->get_data("ucodeDecode", $params);
        }

        function getTransfersFromManager()
        {
            return $this->get_data("getTransfersFromManager", "");
        }
        function getFilesFromManager()
        {
            return $this->get_data("getFilesFromManager", "");
        }
        function abortTransfers($transferId)
        {
            $params = '{
                "transferId": "' . $transferId . '"
            }';
            return $this->get_data("abortTransfers", $params);
        }
        function hideTransfers($transferId)
        {
            $params = '{
                "transferId": "' . $transferId . '"
            }';
            return $this->get_data("hideTransfers", $params);
        }
        function getFile($fileId)
        {
            $params = '{
                "fileId": "' . $fileId . '"
            }';
            return $this->get_data("getFile", $params);
        }
        function deleteFile($fileId)
        {
            $params = '{
                "fileId": "' . $fileId . '"
            }';
            return $this->get_data("deleteFile", $params);
        }
        function sendFileByMessage($to, $fileId)
        {
            $params = '{
                "to": "' . $to . '",
                "fileId": "' . $fileId . '"
            }';
            return $this->get_data("sendFileByMessage", $params);
        }
        function uploadFile($fileDataBase64, $fileName = "")
        {
            $params = '{
                "fileDataBase64": "' . $fileDataBase64 . '",
                "fileName": "' . $fileName . '"
            }';
            return $this->get_data("uploadFile", $params);
        }

        $obj = new call;
        return $obj;
    }
}