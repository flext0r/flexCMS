<?php
/* Articles.php *

Coded by flext0r © 2016

*/

class Articles extends User
{
		public function newArticle($title,$content)
		{
			$Error = [];
			if(empty($title) OR empty($content))
			{
				$Error[] = "Title and content of the article must be filled up!";
			}else{
				if(count($Error) == 0)
				{
					try
					{
						$SQL = $this->db->prepare("INSERT INTO articles (title,content,author,date) VALUES(:title,:content,:author,:date)");
						$SQL->bindParam(':title',$title,PDO::PARAM_STR);
						$SQL->bindParam(':content',$content,PDO::PARAM_STR);
						$SQL->bindParam(':author',$this->get_Data('user_login'),PDO::PARAM_STR);
						$SQL->bindParam(':date',$date,PDO::PARAM_STR);
						$SQL->execute();
						echo '<script>alert("Article named <b>'.$title.'</b> has been created!");</script>';
					}catch(PDOEXCEPTION $e)
					{
						echo $e->getMessage();
					}
				}else{
					return $Error;
				}
			}
		}	
}
					




?>