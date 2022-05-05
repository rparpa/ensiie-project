<?php

namespace Db;

use models\NotificationSwap;

class NotificationManager extends Manager
{

    private UserManager $userManager;

    private SwapManager $swapManager;

    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
        $this->userManager = new UserManager($connection);
        $this->swapManager = new SwapManager($connection);
    }


    public function findAll()
    {
        $notifications = [];
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_notification_swap');
        return $this->executeQueryAndReturnNotifications($pdoStatement, $notifications);
    }

    public function findAllByUserMail(string $mail): array
    {
        $notifications = [];
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_notification_swap WHERE no_user_mail=:mail');
        $pdoStatement->bindValue(':mail', $mail);
        return $this->executeQueryAndReturnNotifications($pdoStatement, $notifications);
    }

    public function findById($id): ?NotificationSwap
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM tc_notification_swap WHERE no_id=:id");
        $pdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
        $execute = $pdoStatement->execute();
        $notification = null;
        if ($execute) {
            $db_row = $pdoStatement->fetch();
            if ($db_row !== false) {
                $notification = new NotificationSwap(
                    $db_row[0],
                    $this->userManager->findById($db_row[1]),
                    $this->swapManager->findById($db_row[2]),
                    $db_row[3]);
            }
        }
        return $notification;
    }

    public function create($object)
    {
        /*
        La génération est automatique via trigger, on ne peut pas créer de notifications
         */
    }

    public function update($object)
    {
        /*
        Les notifications ne sont pas modifiables
         */
    }

    public function deleteById($id)
    {
        $notificationSwap = $this->findById($id);
        if ($notificationSwap instanceof NotificationSwap) {
            $pdoStatement = $this->pdo->prepare('DELETE FROM tc_notification_swap WHERE no_id=:id');
            $pdoStatement->bindValue(':id', $id);
            $pdoStatement->execute();
        }
        return $notificationSwap;
    }

    public function deleteAllByMail($mail): array
    {
        $notificationsSwap = $this->findAllByUserMail($mail);
        $pdoStatement = $this->pdo->prepare('DELETE FROM tc_notification_swap WHERE no_user_mail=:mail');
        $pdoStatement->bindValue(':mail', $mail);
        $pdoStatement->execute();
        return $notificationsSwap;
    }

    public function executeQueryAndReturnNotifications($pdoStatement, array $notifications): array
    {
        $pdoStatement->execute();
        $dbarray = $pdoStatement->fetchAll();
        foreach ($dbarray as $db_row) {
            $notifications[] = new NotificationSwap(
                $db_row[0],
                $this->userManager->findById($db_row[1]),
                $this->swapManager->findById($db_row[2]),
                $db_row[3]);
        }
        return $notifications;
    }
}