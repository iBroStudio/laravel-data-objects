<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Nodes;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerNodeContract;
use IBroStudio\DataObjects\Exceptions\UnhandledValueTypeException;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Support\Arr;
use PhpParser\ConstExprEvaluator;
use PhpParser\Node;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\Float_;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassMethod;

class NodeObject implements FileHandlerNodeContract
{
    public string $type;

    public function __construct(public Node $node)
    {
        $this->type = $this->node->getType();
    }

    public static function make(Node $node): FileHandlerNodeContract
    {
        return match ($node->getType()) {

            'ArrayItem' => new ArrayItemNode($node),

            'Expr_Array' => new ArrayNode($node),

            default => new self($node),
        };
    }

    /**
     * @throws UnhandledValueTypeException
     */
    public static function getValue(Node $node): mixed
    {
        return match ($node::class) {

            Array_::class => ArrayNode::getValue($node),

            ArrayItem::class => ArrayItemNode::getValue($node),

            Node\Stmt\ClassConst::class => self::getValue($node->consts[0]->value),

            ClassConstFetch::class => $node->class->name,

            ClassMethod::class => null,

            ConstFetch::class => (new ConstExprEvaluator)->evaluateDirectly($node),

            String_::class,
            Int_::class,
            Float_::class => $node->value,

            default => throw new UnhandledValueTypeException($node::class),
        };
    }

    /**
     * @throws UnhandledValueTypeException
     */
    public static function wrap(mixed $value): mixed
    {
        return match (gettype($value)) {

            'array' => Arr::map($value, function (mixed $item, int|string $key) {

                return is_array($item) ? $item : new ArrayItem(
                    self::wrap($item),
                    is_string($key) ? new String_($key) : null
                );
            }),

            'boolean' => new ConstFetch(new Name(var_export($value, true))),

            'integer' => new Int_($value),

            'float', 'double' => new Float_($value),

            'object' => match (get_class($value)) {

                ClassString::class => new ClassConstFetch(new FullyQualified($value->value), 'class'),

                default => throw new UnhandledValueTypeException(get_class($value)),
            },

            'string' => new String_($value),

            default => throw new UnhandledValueTypeException((string) gettype($value)),
        };
    }

    public function add(mixed $value): self
    {
        return $this;
    }

    public function name(): string
    {
        // @phpstan-ignore-next-line
        return $this->node->name->toString();
    }

    /**
     * @throws UnhandledValueTypeException
     */
    public function value(): mixed
    {
        return static::getValue($this->node);
    }

    public function replaceBy(mixed $value): self
    {
        // @phpstan-ignore-next-line
        $this->node->value = $value;

        return $this;
    }
}
