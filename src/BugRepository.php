<?php

use Doctrine\ORM\EntityRepository;

class BugRepository extends EntityRepository
{
    public function getRecentBugs(int $number): array
    {
        $dql = "
            SELECT b, e, r
            FROM Bug b
                JOIN b.engineer e
                JOIN b.reporter r
            ORDER BY b.created DESC
        ";

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery($dql);
        $query->setMaxResults($number);
        $bugs = $query->getResult();
        return $bugs;
    }

    public function getRecentBugsArray(int $number): array
    {
        $dql = "
            SELECT b, e, r, p
            FROM Bug b
                JOIN b.engineer e
                JOIN b.reporter r
                JOIN b.products p
            ORDER BY b.created DESC
        ";

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery($dql);
        $query->setMaxResults($number);
        $bugs = $query->getArrayResult();
        return $bugs;
    }

    public function getUsersBugs(int $userId, int $number): array
    {
        $dql = "
            SELECT b, e, r
            FROM Bug b
                JOIN b.engineer e
                JOIN b.reporter r
            WHERE b.type = 'OPEN' AND (e.id = ?1 OR r.id = ?1)
            ORDER BY b.created DESC
        ";

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery($dql);
        $query->setParameter(1, $userId);
        $query->setMaxResults($number);

        $userBugs = $query->getResult();
        return $userBugs;
    }

    public function getOpenBugsByProduct(): array
    {
        $dql = "
            SELECT p.id, p.name, COUNT(b.id) as openBugs
            FROM Bug b
                JOIN b.products p
            WHERE b.type = 'OPEN'
            GROUP BY p.id
        ";

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery($dql);
        $productBugs = $query->getScalarResult();
        return $productBugs;
    }
}
