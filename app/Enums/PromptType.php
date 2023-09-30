<?php

namespace App\Enums;

class PromptType
{
    const INSERT = 'insert';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const SELECT = 'select';
    const FILTER = 'filter';
    const JOIN = 'join';
    const AGGREGATE = 'aggregate';
    const GROUP = 'group';
    const SORT = 'sort';
    const MODIFY = 'modify';
    const TRANSACTION = 'transaction';
    const PERFORMANCE = 'performance';
    const REPORT = 'report';

    // Compound Types
    const FILTER_AGGREGATE = 'filter_aggregate';
    const SELECT_JOIN = 'select_join';

    public static function all(): array
    {
        return [
            self::INSERT,
            self::UPDATE,
            self::DELETE,
            self::SELECT,
            self::FILTER,
            self::JOIN,
            self::AGGREGATE,
            self::GROUP,
            self::SORT,
            self::MODIFY,
            self::TRANSACTION,
            self::PERFORMANCE,
            self::REPORT,
            self::FILTER_AGGREGATE,
            self::SELECT_JOIN,
        ];
    }
}
