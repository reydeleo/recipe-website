<?php

namespace Base;

use \Steps as ChildSteps;
use \StepsQuery as ChildStepsQuery;
use \Exception;
use \PDO;
use Map\StepsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'steps' table.
 *
 *
 *
 * @method     ChildStepsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStepsQuery orderByStepNumber($order = Criteria::ASC) Order by the step_number column
 * @method     ChildStepsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildStepsQuery orderByRecipeId($order = Criteria::ASC) Order by the recipe_id column
 *
 * @method     ChildStepsQuery groupById() Group by the id column
 * @method     ChildStepsQuery groupByStepNumber() Group by the step_number column
 * @method     ChildStepsQuery groupByDescription() Group by the description column
 * @method     ChildStepsQuery groupByRecipeId() Group by the recipe_id column
 *
 * @method     ChildStepsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStepsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStepsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStepsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStepsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStepsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStepsQuery leftJoinRecipe($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recipe relation
 * @method     ChildStepsQuery rightJoinRecipe($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recipe relation
 * @method     ChildStepsQuery innerJoinRecipe($relationAlias = null) Adds a INNER JOIN clause to the query using the Recipe relation
 *
 * @method     ChildStepsQuery joinWithRecipe($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Recipe relation
 *
 * @method     ChildStepsQuery leftJoinWithRecipe() Adds a LEFT JOIN clause and with to the query using the Recipe relation
 * @method     ChildStepsQuery rightJoinWithRecipe() Adds a RIGHT JOIN clause and with to the query using the Recipe relation
 * @method     ChildStepsQuery innerJoinWithRecipe() Adds a INNER JOIN clause and with to the query using the Recipe relation
 *
 * @method     \RecipeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSteps findOne(ConnectionInterface $con = null) Return the first ChildSteps matching the query
 * @method     ChildSteps findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSteps matching the query, or a new ChildSteps object populated from the query conditions when no match is found
 *
 * @method     ChildSteps findOneById(int $id) Return the first ChildSteps filtered by the id column
 * @method     ChildSteps findOneByStepNumber(int $step_number) Return the first ChildSteps filtered by the step_number column
 * @method     ChildSteps findOneByDescription(string $description) Return the first ChildSteps filtered by the description column
 * @method     ChildSteps findOneByRecipeId(int $recipe_id) Return the first ChildSteps filtered by the recipe_id column *

 * @method     ChildSteps requirePk($key, ConnectionInterface $con = null) Return the ChildSteps by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSteps requireOne(ConnectionInterface $con = null) Return the first ChildSteps matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSteps requireOneById(int $id) Return the first ChildSteps filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSteps requireOneByStepNumber(int $step_number) Return the first ChildSteps filtered by the step_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSteps requireOneByDescription(string $description) Return the first ChildSteps filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSteps requireOneByRecipeId(int $recipe_id) Return the first ChildSteps filtered by the recipe_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSteps[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSteps objects based on current ModelCriteria
 * @method     ChildSteps[]|ObjectCollection findById(int $id) Return ChildSteps objects filtered by the id column
 * @method     ChildSteps[]|ObjectCollection findByStepNumber(int $step_number) Return ChildSteps objects filtered by the step_number column
 * @method     ChildSteps[]|ObjectCollection findByDescription(string $description) Return ChildSteps objects filtered by the description column
 * @method     ChildSteps[]|ObjectCollection findByRecipeId(int $recipe_id) Return ChildSteps objects filtered by the recipe_id column
 * @method     ChildSteps[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StepsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StepsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Steps', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStepsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStepsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStepsQuery) {
            return $criteria;
        }
        $query = new ChildStepsQuery();
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
     * @return ChildSteps|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StepsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StepsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSteps A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, step_number, description, recipe_id FROM steps WHERE id = :p0';
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
            /** @var ChildSteps $obj */
            $obj = new ChildSteps();
            $obj->hydrate($row);
            StepsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSteps|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StepsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StepsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(StepsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StepsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StepsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the step_number column
     *
     * Example usage:
     * <code>
     * $query->filterByStepNumber(1234); // WHERE step_number = 1234
     * $query->filterByStepNumber(array(12, 34)); // WHERE step_number IN (12, 34)
     * $query->filterByStepNumber(array('min' => 12)); // WHERE step_number > 12
     * </code>
     *
     * @param     mixed $stepNumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function filterByStepNumber($stepNumber = null, $comparison = null)
    {
        if (is_array($stepNumber)) {
            $useMinMax = false;
            if (isset($stepNumber['min'])) {
                $this->addUsingAlias(StepsTableMap::COL_STEP_NUMBER, $stepNumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stepNumber['max'])) {
                $this->addUsingAlias(StepsTableMap::COL_STEP_NUMBER, $stepNumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StepsTableMap::COL_STEP_NUMBER, $stepNumber, $comparison);
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
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StepsTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the recipe_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRecipeId(1234); // WHERE recipe_id = 1234
     * $query->filterByRecipeId(array(12, 34)); // WHERE recipe_id IN (12, 34)
     * $query->filterByRecipeId(array('min' => 12)); // WHERE recipe_id > 12
     * </code>
     *
     * @see       filterByRecipe()
     *
     * @param     mixed $recipeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function filterByRecipeId($recipeId = null, $comparison = null)
    {
        if (is_array($recipeId)) {
            $useMinMax = false;
            if (isset($recipeId['min'])) {
                $this->addUsingAlias(StepsTableMap::COL_RECIPE_ID, $recipeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recipeId['max'])) {
                $this->addUsingAlias(StepsTableMap::COL_RECIPE_ID, $recipeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StepsTableMap::COL_RECIPE_ID, $recipeId, $comparison);
    }

    /**
     * Filter the query by a related \Recipe object
     *
     * @param \Recipe|ObjectCollection $recipe The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStepsQuery The current query, for fluid interface
     */
    public function filterByRecipe($recipe, $comparison = null)
    {
        if ($recipe instanceof \Recipe) {
            return $this
                ->addUsingAlias(StepsTableMap::COL_RECIPE_ID, $recipe->getId(), $comparison);
        } elseif ($recipe instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StepsTableMap::COL_RECIPE_ID, $recipe->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRecipe() only accepts arguments of type \Recipe or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Recipe relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function joinRecipe($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Recipe');

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
            $this->addJoinObject($join, 'Recipe');
        }

        return $this;
    }

    /**
     * Use the Recipe relation Recipe object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RecipeQuery A secondary query class using the current class as primary query
     */
    public function useRecipeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRecipe($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Recipe', '\RecipeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSteps $steps Object to remove from the list of results
     *
     * @return $this|ChildStepsQuery The current query, for fluid interface
     */
    public function prune($steps = null)
    {
        if ($steps) {
            $this->addUsingAlias(StepsTableMap::COL_ID, $steps->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the steps table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StepsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StepsTableMap::clearInstancePool();
            StepsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StepsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StepsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StepsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StepsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StepsQuery
