/*�û�������user_action ����value �����ڴ��rankֵ by wewe 20130509*/
ALTER TABLE  `xiami_user_action` ADD  `value` VARCHAR( 20 ) NOT NULL COMMENT  'ֵ' AFTER  `user_id` ;
ALTER TABLE  `xiami_user_action` COMMENT =  '�û�������������/�ڴ�/rank';

/*��Ʒ��works���� �Ǽ������� �����ܴ���  by wewe 20130509*/
ALTER TABLE  `xiami_works` ADD  `rank_total` BIGINT NOT NULL DEFAULT  '0' COMMENT  '�Ǽ�������' AFTER  `good` ,
ADD  `rank_count` BIGINT NOT NULL DEFAULT  '0' COMMENT  '�Ǽ������ܴ���' AFTER  `rank_total` ;

ALTER TABLE  `xiami_works_special` ADD  `description` VARCHAR( 255 ) NOT NULL COMMENT  '����' AFTER  `title` ;
ALTER TABLE  `xiami_works_special` ADD  `img` VARCHAR( 200 ) NOT NULL COMMENT  '����ͼ';
ALTER TABLE  `xiami_works_special` ADD  `award` VARCHAR( 50 ) NOT NULL COMMENT  '����';
ALTER TABLE  `xiami_works_special` ADD  `is_top` TINYINT( 1 ) NOT NULL DEFAULT  '0' COMMENT  '�Ƿ��Ƽ�' AFTER  `code` ,
ADD  `top_sid` INT NOT NULL DEFAULT  '0' COMMENT  '�Ƽ�����' AFTER  `is_top` ;
