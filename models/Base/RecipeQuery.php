<?php

namespace Base;

use \Recipe as ChildRecipe;
use \RecipeQuery as ChildRecipeQuery;
use \Exception;
use \PDO;
use Map\RecipeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'recipe' table.
 *
 *
 *
 * @method     ChildRecipeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRecipeQuery orderByImageUrl($order = Criteria::ASC) Order by the image_url column
 * @method     ChildRecipeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildRecipeQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildRecipeQuery orderByPrepTime($order = Criteria::ASC) Order by the prep_time column
 * @method     ChildRecipeQuery orderByTotalTime($order = Criteria::ASC) Order by the total_time column
 *
 * @method     ChildRecipeQuery groupById() Group by the id column
 * @method     ChildRecipeQuery groupByImageUrl() Group by the image_url column
 * @method     ChildRecipeQuery groupByName() Group by the name column
 * @method     ChildRecipeQuery groupByDescription() Group by the description column
 * @method     ChildRecipeQuery groupByPrepTime() Group by the prep_time column
 * @method     ChildRecipeQuery groupByTotalTime() Group by the total_time column
 *
 * @method     ChildRecipeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRecipeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRecipeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRecipeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRecipeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRecipeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRecipeQuery leftJoinSteps($relationAlias = null) Adds a LEFT JOIN clause to the query using the Steps relation
 * @method     ChildRecipeQuery rightJoinSteps($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Steps relation
 * @method     ChildRecipeQuery innerJoinSteps($relationAlias = null) Adds a INNER JOIN clause to the query using the Steps relation
 *
 * @method     ChildRecipeQuery joinWithSteps($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Steps relation
 *
 * @method     ChildRecipeQuery leftJoinWithSteps() Adds a LEFT JOIN clause and with to the query using the Steps relation
 * @method     ChildRecipeQuery rightJoinWithSteps() Adds a RIGHT JOIN clause and with to the query using the Steps relation
 * @method     ChildRecipeQuery innerJoinWithSteps() Adds a INNER JOIN clause and with to the query using the Steps relation
 *
 * @method     \StepsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRecipe findOne(ConnectionInterface $con = null) Return the first ChildRecipe matching the query
 * @method     ChildRecipe findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRecipe matching the query, or a new ChildRecipe object populated from the query conditions when no match is found
 *
 * @method     ChildRecipe findOneById(int $id) Return the first ChildRecipe filtered by the id column
 * @method     ChildRecipe findOneByImageUrl(string $image_url) Return the first ChildRecipe filtered by the image_url column
 * @method     ChildRecipe findOneByName(string $name) Return the first ChildRecipe filtered by the name column
 * @method     ChildRecipe findOneByDescription(string $description) Return the first ChildRecipe filtered by the description column
 * @method     ChildRecipe findOneByPrepTime(int $prep_time) Return the first ChildRecipe filtered by the prep_time column
 * @method     ChildRecipe findOneByTotalTime(int $total_time) Return the first ChildRecipe filtered by the total_time column *

 * @method     ChildRecipe requirePk($key, ConnectionInterface $con = null) Return the ChildRecipe by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOne(ConnectionInterface $con = null) Return the first ChildRecipe matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRecipe requireOneById(int $id) Return the first ChildRecipe filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByImageUrl(string $image_url) Return the first ChildRecipe filtered by the image_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByName(string $name) Return the first ChildRecipe filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByDescription(string $description) Return the first ChildRecipe filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByPrepTime(int $prep_time) Return the first ChildRecipe filtered by the prep_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipe requireOneByTotalTime(int $total_time) Return the first ChildRecipe filtered by the total_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRecipe[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRecipe objects based on current ModelCriteria
 * @method     ChildRecipe[]|ObjectCollection findById(int $id) Return ChildRecipe objects filtered by the id column
 * @method     ChildRecipe[]|ObjectCollection findByImageUrl(string $image_url) Return ChildRecipe objects filtered by the image_url column
 * @method     ChildRecipe[]|ObjectCollection findByName(string $name) Return ChildRecipe objects filtered by the name column
 * @method     ChildRecipe[]|ObjectCollection findByDescription(string $description) Return ChildRecipe objects filtered by the description column
 * @method     ChildRecipe[]|ObjectCollection findByPrepTime(int $prep_time) Return ChildRecipe objects filtered by the prep_time column
 * @method     ChildRecipe[]|ObjectCollection findByTotalTime(int $total_time) Return ChildRecipe objects filtered by the total_time column
 * @method     ChildRecipe[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RecipeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RecipeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Recipe', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRecipeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRecipeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRecipeQuery) {
            return $criteria;
        }
        $query = new ChildRecipeQuery();
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
     * @return ChildRecipe|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RecipeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RecipeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRecipe A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, image_url, name, description, prep_time, total_time FROM recipe WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRecipe $obj */
            $obj = new ChildRecipe();
            $obj->hydrate($row);
            RecipeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRecipe|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RecipeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RecipeTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecipeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the image_url column
     *
     * Example usage:
     * <code>
     * $query->filterByImageUrl('fooValue');   // WHERE image_url = 'fooValue'
     * $query->filterByImageUrl('%fooValue%', Criteria::LIKE); // WHERE image_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageUrl The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterByImageUrl($imageUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageUrl)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecipeTableMap::COL_IMAGE_URL, $imageUrl, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecipeTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecipeTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the prep_time column
     *
     * Example usage:
     * <code>
     * $query->filterByPrepTime(1234); // WHERE prep_time = 1234
     * $query->filterByPrepTime(array(12, 34)); // WHERE prep_time IN (12, 34)
     * $query->filterByPrepTime(array('min' => 12)); // WHERE prep_time > 12
     * </code>
     *
     * @param     mixed $prepTime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterByPrepTime($prepTime = null, $comparison = null)
    {
        if (is_array($prepTime)) {
            $useMinMax = false;
            if (isset($prepTime['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_PREP_TIME, $prepTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prepTime['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_PREP_TIME, $prepTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecipeTableMap::COL_PREP_TIME, $prepTime, $comparison);
    }

    /**
     * Filter the query on the total_time column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalTime(1234); // WHERE total_time = 1234
     * $query->filterByTotalTime(array(12, 34)); // WHERE total_time IN (12, 34)
     * $query->filterByTotalTime(array('min' => 12)); // WHERE total_time > 12
     * </code>
     *
     * @param     mixed $totalTime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function filterByTotalTime($totalTime = null, $comparison = null)
    {
        if (is_array($totalTime)) {
            $useMinMax = false;
            if (isset($totalTime['min'])) {
                $this->addUsingAlias(RecipeTableMap::COL_TOTAL_TIME, $totalTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalTime['max'])) {
                $this->addUsingAlias(RecipeTableMap::COL_TOTAL_TIME, $totalTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecipeTableMap::COL_TOTAL_TIME, $totalTime, $comparison);
    }

    /**
     * Filter the query by a related \Steps object
     *
     * @param \Steps|ObjectCollection $steps the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRecipeQuery The current query, for fluid interface
     */
    public function filterBySteps($steps, $comparison = null)
    {
        if ($steps instanceof \Steps) {
            return $this
                ->addUsingAlias(RecipeTableMap::COL_ID, $steps->getRecipeId(), $comparison);
        } elseif ($steps instanceof ObjectCollection) {
            return $this
                ->useStepsQuery()
                ->filterByPrimaryKeys($steps->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySteps() only accepts arguments of type \Steps or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Steps relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function joinSteps($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Steps');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Steps');
        }

        return $this;
    }

    /**
     * Use the Steps relation Steps object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StepsQuery A secondary query class using the current class as primary query
     */
    public function useStepsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSteps($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Steps', '\StepsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRecipe $recipe Object to remove from the list of results
     *
     * @return $this|ChildRecipeQuery The current query, for fluid interface
     */
    public function prune($recipe = null)
    {
        if ($recipe) {
            $this->addUsingAlias(RecipeTableMap::COL_ID, $recipe->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the recipe table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RecipeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RecipeTableMap::clearInstancePool();
            RecipeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RecipeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RecipeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RecipeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RecipeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RecipeQuery
