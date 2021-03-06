<?php

namespace Serato\SwsApp\Test\Propel\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Serato\SwsApp\Test\Propel\Model\License as ChildLicense;
use Serato\SwsApp\Test\Propel\Model\LicenseQuery as ChildLicenseQuery;
use Serato\SwsApp\Test\Propel\Model\Map\LicenseTableMap;

/**
 * Base class that represents a query for the 'product_licenses' table.
 *
 *
 *
 * @method     ChildLicenseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLicenseQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildLicenseQuery orderByLicenseTypeId($order = Criteria::ASC) Order by the license_type_id column
 *
 * @method     ChildLicenseQuery groupById() Group by the id column
 * @method     ChildLicenseQuery groupByProductId() Group by the product_id column
 * @method     ChildLicenseQuery groupByLicenseTypeId() Group by the license_type_id column
 *
 * @method     ChildLicenseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLicenseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLicenseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLicenseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLicenseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLicenseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLicense findOne(ConnectionInterface $con = null) Return the first ChildLicense matching the query
 * @method     ChildLicense findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLicense matching the query, or a new ChildLicense object populated from the query conditions when no match is found
 *
 * @method     ChildLicense findOneById(string $id) Return the first ChildLicense filtered by the id column
 * @method     ChildLicense findOneByProductId(string $product_id) Return the first ChildLicense filtered by the product_id column
 * @method     ChildLicense findOneByLicenseTypeId(int $license_type_id) Return the first ChildLicense filtered by the license_type_id column *

 * @method     ChildLicense requirePk($key, ConnectionInterface $con = null) Return the ChildLicense by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOne(ConnectionInterface $con = null) Return the first ChildLicense matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLicense requireOneById(string $id) Return the first ChildLicense filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOneByProductId(string $product_id) Return the first ChildLicense filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOneByLicenseTypeId(int $license_type_id) Return the first ChildLicense filtered by the license_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLicense[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLicense objects based on current ModelCriteria
 * @method     ChildLicense[]|ObjectCollection findById(string $id) Return ChildLicense objects filtered by the id column
 * @method     ChildLicense[]|ObjectCollection findByProductId(string $product_id) Return ChildLicense objects filtered by the product_id column
 * @method     ChildLicense[]|ObjectCollection findByLicenseTypeId(int $license_type_id) Return ChildLicense objects filtered by the license_type_id column
 * @method     ChildLicense[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LicenseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Serato\SwsApp\Test\Propel\Model\Base\LicenseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Serato\\SwsApp\\Test\\Propel\\Model\\License', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLicenseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLicenseQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLicenseQuery) {
            return $criteria;
        }
        $query = new ChildLicenseQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildLicense|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LicenseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LicenseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLicense A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, product_id, license_type_id FROM product_licenses WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildLicense $obj */
            $obj = new ChildLicense();
            $obj->hydrate($row);
            LicenseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildLicense|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LicenseTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LicenseTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId('fooValue');   // WHERE product_id = 'fooValue'
     * $query->filterByProductId('%fooValue%', Criteria::LIKE); // WHERE product_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the license_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLicenseTypeId(1234); // WHERE license_type_id = 1234
     * $query->filterByLicenseTypeId(array(12, 34)); // WHERE license_type_id IN (12, 34)
     * $query->filterByLicenseTypeId(array('min' => 12)); // WHERE license_type_id > 12
     * </code>
     *
     * @param     mixed $licenseTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByLicenseTypeId($licenseTypeId = null, $comparison = null)
    {
        if (is_array($licenseTypeId)) {
            $useMinMax = false;
            if (isset($licenseTypeId['min'])) {
                $this->addUsingAlias(LicenseTableMap::COL_LICENSE_TYPE_ID, $licenseTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($licenseTypeId['max'])) {
                $this->addUsingAlias(LicenseTableMap::COL_LICENSE_TYPE_ID, $licenseTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_LICENSE_TYPE_ID, $licenseTypeId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLicense $license Object to remove from the list of results
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function prune($license = null)
    {
        if ($license) {
            $this->addUsingAlias(LicenseTableMap::COL_ID, $license->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_licenses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LicenseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LicenseTableMap::clearInstancePool();
            LicenseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LicenseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LicenseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LicenseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LicenseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LicenseQuery
