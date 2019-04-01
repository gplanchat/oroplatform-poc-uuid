<?php

namespace AppBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class AppBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createPersonTable($schema);
        $this->createTicketTable($schema);
        $this->createTicketAssignedTable($schema);

        /** Foreign keys generation **/
        $this->addTicketAssignedForeignKeys($schema);
        $this->addTicketForeignKeys($schema);
    }

    /**
     * Create person table
     *
     * @param Schema $schema
     */
    private function createPersonTable(Schema $schema): void
    {
        $table = $schema->createTable('person');
        $table->addColumn('uuid', 'uuid', ['comment' => '(DC2Type:uuid)']);
        $table->addColumn('firstname', 'text', []);
        $table->addColumn('lastname', 'text', []);
        $table->addColumn('email', 'text', []);
        $table->setPrimaryKey(['uuid']);
    }

    private function createTicketTable(Schema $schema): void
    {
        $table = $schema->createTable('ticket');
        $table->addColumn('uuid', 'uuid', ['comment' => '(DC2Type:uuid)']);
        $table->addColumn('author_id', 'uuid', ['notnull' => false, 'comment' => '(DC2Type:uuid)']);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('content', 'text', []);
        $table->addIndex(['author_id'], 'idx_97a0ada3f675f31b', []);
        $table->setPrimaryKey(['uuid']);
    }

    /**
     * Create ticket_assigned table
     *
     * @param Schema $schema
     */
    protected function createTicketAssignedTable(Schema $schema)
    {
        $table = $schema->createTable('ticket_assigned');
        $table->addColumn('ticket_id', 'uuid', ['comment' => '(DC2Type:uuid)']);
        $table->addColumn('assigned_id', 'uuid', ['comment' => '(DC2Type:uuid)']);
        $table->setPrimaryKey(['ticket_id', 'assigned_id']);
        $table->addIndex(['assigned_id'], 'idx_8ef3301be1501a05', []);
        $table->addIndex(['ticket_id'], 'idx_8ef3301b700047d2', []);
    }

    private function addTicketAssignedForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('ticket_assigned');
        $table->addForeignKeyConstraint(
            $schema->getTable('ticket'),
            ['assigned_id'],
            ['uuid'],
            ['onUpdate' => null, 'onDelete' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('person'),
            ['ticket_id'],
            ['uuid'],
            ['onUpdate' => null, 'onDelete' => null]
        );
    }

    private function addTicketForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('ticket');
        $table->addForeignKeyConstraint(
            $schema->getTable('person'),
            ['author_id'],
            ['uuid'],
            ['onUpdate' => null, 'onDelete' => null]
        );
    }
}
