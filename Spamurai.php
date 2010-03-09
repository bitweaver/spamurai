<?php

require_once (SPAMURAI_PKG_PATH.'Akismet.class.php');

//TODO: Mark as spam button on forums, calls $akismet->submitSpam.
//TODO: Also, submitHam
//TODO: Auto ban system, where if comment is blocked as spam over a threshold limit, auto ban user (example...)
//TODO: getList from spamurai_log

function spamurai_content_verify($pObject, $pParamHash){
	global $gBitUser, $gBitSystem;	
	if( $gBitSystem->isPackageActive( 'spamurai' ) && is_a($pObject,'LibertyContent') ){ 
		$akismet = new Akismet( BOARDS_PKG_URI , $gBitSystem->getConfig('spamurai_api_key') );

		if( !empty($pParamHash) && !empty($akismet) ) {
			$userInfo = $gBitUser->getUserInfo( array ('user_id' => $pParamHash['user_id'] ) );	
			$akismet->setCommentAuthor( $userInfo['real_name'].$userInfo['login'] );
			$akismet->setCommentAuthorEmail($userInfo['email']);
			$checkTitle = '';
			if( !empty( $pParamHash['title'] ) ) {
				$checkTitle .= $pParamHash['title'];
			}
			if( !empty( $pParamHash['comment_title'] ) ) {
				$checkTitle .= $pParamHash['comment_title'];
			}
			$checkString = '';
			if( !empty( $pParamHash['edit'] ) ) {
				$checkString .= $pParamHash['edit'];
			}
			if( !empty( $pParamHash['comment_data'] ) ) {
				$checkString .= $pParamHash['comment_data'];
			}
			if( !empty( $checkString ) || !empty( $checkTitle ) ) {
bit_log_error( 'checking '.$pObject->getContentType().' '.$userInfo['user_id'] );
				$akismet->setCommentContent( $checkTitle.$checkString );
				if($akismet->isCommentSpam()){
bit_log_error( 'SPAM '.$pObject->getContentType().' '.$userInfo['user_id'] );
					$insertSql = "INSERT INTO ".BIT_DB_PREFIX."spamurai_log (user_id, email, subject, data, posted_date) VALUES ( ?, ?, ?, ?, ? )";
					$bindVars = array ( $pParamHash['user_id'], $userInfo['email'], substr( $checkTitle, 0, 255 ), $checkString, time() );
					$gBitSystem->mDb->query( $insertSql, $bindVars );
					$pObject->mErrors['spam'] = "This comment has been blocked as spam"; 			
				}
			}
		}
	}
}

