<?php
//Comment class
class Comment
{
    private $commentID;
    private $commentText;
    private $commentDateAndTime;
    private $reviewID;
    private $userLoginID;
    private $likes;
    public function __construct($commentID, $commentText, $commentDateAndTime, $reviewID, $userLoginID, $likes)
    {
        $this->commentID = $commentID;
        $this->commentText = $commentText;
        $this->commentDateAndTime = $commentDateAndTime;
        $this->reviewID = $reviewID;
        $this->userLoginID = $userLoginID;
        $this->likes = $likes;
    }

    public function getCommentID()
    {
        return $this->commentID;
    }

    public function getCommentText()
    {
        return $this->commentText;
    }

    public function getCommentDateAndTime()
    {
        return $this->commentDateAndTime;
    }

    public function getReviewID()
    {
        return $this->reviewID;
    }

    public function getUserLoginID()
    {
        return $this->userLoginID;
    }

    public function getLikes()
    {
        return $this->likes;
    }



    //Function to save new comments written by ordinary users.
    public static function save(Comment $comment) {
        require'../backend/DBconnect.php';

        $sql = "INSERT INTO comments 
            (CommentID, ReviewID,  UserLoginID, CommentText,  Likes, DateAndTime)
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $comment->getCommentID(),
            $comment->getReviewID(),
            $comment->getUserLoginID(),
            $comment->getCommentText(),
            $comment->getLikes(),
            $comment->getCommentDateAndTime()
        ]);
    }

    //Loads comments from the database which belong to a specific review.
    public static function loadByReviewId($reviewId): array
    {
        require '../../backend/DBconnect.php';
        $sql = "SELECT * FROM comments WHERE ReviewID = ? ORDER BY DateAndTime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$reviewId]);

        $comments = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $comments[] = new Comment(
                $row['CommentID'],
                $row['CommentText'],
                $row['DateAndTime'],
                $row['ReviewID'],
                $row['UserLoginID'],
                $row['Likes']
            );
        }
        return $comments;
    }

    //Loads comments from the database which belong to a specific user.
    public static function loadByUserId($UserId): array
    {
        require'../../backend/DBconnect.php';
        $sql = "SELECT * FROM comments WHERE UserLoginID = ? ORDER BY DateAndTime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$UserId]);

        $comments = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $comments[] = new Comment(
                $row['CommentID'],
                $row['CommentText'],
                $row['DateAndTime'],
                $row['ReviewID'],
                $row['UserLoginID'],
                $row['Likes']
            );
        }
        return $comments;
    }
}
