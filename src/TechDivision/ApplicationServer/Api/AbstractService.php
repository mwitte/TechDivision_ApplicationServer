<?php
/**
 * TechDivision\ApplicationServer\Api\AbstractService
 *
 * PHP version 5
 *
 * @category   Appserver
 * @package    TechDivision_ApplicationServer
 * @subpackage Api
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */

namespace TechDivision\ApplicationServer\Api;

use TechDivision\ApplicationServer\InitialContext;
use TechDivision\ApplicationServer\Api\Node\NodeInterface;
use TechDivision\ApplicationServer\Utilities\DirectoryKeys;
use TechDivision\PersistenceContainer\Application;

/**
 * Abstract service implementation.
 *
 * @category   Appserver
 * @package    TechDivision_ApplicationServer
 * @subpackage Api
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */
abstract class AbstractService implements ServiceInterface
{

    /**
     * The node type to normalize to.
     *
     * @var string
     */
    const NODE_TYPE = 'TechDivision\ApplicationServer\Api\Node\AppserverNode';

    /**
     * The initial context instance containing the system configuration.
     *
     * @var \TechDivision\ApplicationServer\InitialContext
     */
    protected $initialContext;

    /**
     * The normalizer instance to use.
     *
     * @var \TechDivision\ApplicationServer\Api\NormalizerInterface
     */
    protected $normalizer;

    /**
     * The initialized base directory node.
     *
     * @var \TechDivision\ApplicationServer\Api\Node\NodeInterface
     */
    protected $node;

    /**
     * Initializes the service with the initial context instance and the
     * default normalizer instance.
     *
     * @param \TechDivision\ApplicationServer\InitialContext $initialContext The initial context instance
     */
    public function __construct(InitialContext $initialContext)
    {
        $this->initialContext = $initialContext;
    }

    /**
     * (non-PHPdoc)
     *
     * @return \TechDivision\ApplicationServer\InitialContext The initial Context
     * @see ServiceInterface::getInitialContext()
     */
    public function getInitialContext()
    {
        return $this->initialContext;
    }

    /**
     * (non-PHPdoc)
     *
     * @return \TechDivision\ApplicationServer\Api\Node\NodeInterface The system configuration
     * @see \TechDivision\ApplicationServer\Api\ServiceInterface::getSystemConfiguration()
     */
    public function getSystemConfiguration()
    {
        return $this->getInitialContext()->getSystemConfiguration();
    }

    /**
     * (non-PHPdoc)
     *
     * @param \TechDivision\ApplicationServer\Api\Node\NodeInterface $systemConfiguration The system configuration
     *
     * @return \TechDivision\ApplicationServer\Api\ServiceInterface
     * @see \TechDivision\ApplicationServer\Api\ServiceInterface::setSystemConfiguration()
     */
    public function setSystemConfiguration(NodeInterface $systemConfiguration)
    {
        $this->getInitialContext()->setSystemConfiguration($systemConfiguration);
    }

    /**
     * (non-PHPdoc)
     *
     * @param string $className The fully qualified class name to return the instance for
     * @param array  $args      Arguments to pass to the constructor of the instance
     *
     * @return object The instance itself
     * @see \TechDivision\ApplicationServer\InitialContext::newInstance()
     */
    public function newInstance($className, array $args = array())
    {
        return $this->getInitialContext()->newInstance($className, $args);
    }

    /**
     * (non-PHPdoc)
     *
     * @param string $className The API service class name to return the instance for
     *
     * @return \TechDivision\ApplicationServer\Api\ServiceInterface The service instance
     * @see \TechDivision\ApplicationServer\InitialContext::newService()
     */
    public function newService($className)
    {
        return $this->getInitialContext()->newService($className);
    }

    /**
     * Returns the application servers base directory.
     *
     * @param string|null $directoryToAppend Append this directory to the base directory before returning it
     *
     * @return string The base directory
     */
    public function getBaseDirectory($directoryToAppend = null)
    {
        $baseDirectory = $this->getSystemConfiguration()
            ->getBaseDirectory()
            ->getNodeValue()
            ->__toString();

        if ($directoryToAppend != null) {
            $baseDirectory .= $directoryToAppend;
        }

        return $baseDirectory;
    }

    /**
     * Return's the directory structure to be created at first start.
     *
     * @return array The directory structure to be created if necessary
     */
    public function getDirectories()
    {
        return DirectoryKeys::getDirectories();
    }

    /**
     * Returns the servers tmp directory
     *
     * @return string
     */
    public function getTmpDir()
    {
        return $this->realpath(DirectoryKeys::TMP);
    }

    /**
     * Returns the servers deploy directory
     *
     * @return string
     */
    public function getDeployDir()
    {
        return $this->realpath(DirectoryKeys::DEPLOY);
    }

    /**
     * Returns the servers webapps directory
     *
     * @return string
     */
    public function getWebappsDir()
    {
        return $this->realpath(DirectoryKeys::WEBAPPS);
    }

    /**
     * Returns the servers log directory
     *
     * @return string
     */
    public function getLogDir()
    {
        return $this->realpath(DirectoryKeys::LOG);
    }

    /**
     * Returns the absolute path to the passed directory, also
     * working on Windows.
     *
     * @param string $relativeDirectory The relativ path of the directory to return the absolute path for
     *
     * @return string The absolute path of the passed directory
     */
    public function realpath($relativeDirectory)
    {
        return $this->getBaseDirectory(DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativeDirectory));
    }

    /**
     * Persists the system configuration.
     *
     * @param NodeInterface $node A node to persist
     *
     * @return void
     */
    public function persist(NodeInterface $node)
    {
        // implement this
    }
}
