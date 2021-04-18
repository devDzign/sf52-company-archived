<?php


namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Loggable\Entity\LogEntry;


/**
 * @method LogEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogEntry[]    findAll()
 * @method LogEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogEntry::class);
    }



    /**
     * @param Company $company
     * @param         $limit
     *
     * @return int|mixed[]|string
     */
    public function getListVersioned(Company $company, $limit=1)
    {
        return $this->createQueryBuilder("log_entry")
            ->select(
                "log_entry.id",
                "log_entry.objectId",
                "log_entry.loggedAt",
                "log_entry.version",
                "log_entry.username",
                "log_entry.data",
            )
            ->andWhere("log_entry.objectClass = :oc ")
            ->andWhere("log_entry.objectId = :oid ")
            ->setParameter("oc", Company::class)
            ->setParameter("oid", $company->getId())
            ->orderBy('log_entry.version', 'desc')
//            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    /**
     * @param Company $company
     * @param         $limit
     *
     * @return int|mixed[]|string
     */
    public function getOneByDate(Company $company, \DateTime $dateTime)
    {
        return $this->createQueryBuilder("log_entry")
            ->select(
                "log_entry.id",
                "log_entry.objectId",
                "log_entry.loggedAt",
                "log_entry.version",
                "log_entry.username",
                "log_entry.action",
                "log_entry.data",
            )
            ->andWhere("log_entry.objectClass = :oc ")
            ->andWhere("log_entry.objectId = :oid ")
            ->andWhere("log_entry.loggedAt >= :date ")
            ->setParameter("oc", Company::class)
            ->setParameter("oid", $company->getId())
            ->setParameter("date", $dateTime)
            ->orderBy('log_entry.version', 'desc')
//            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

}