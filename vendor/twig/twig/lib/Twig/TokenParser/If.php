<?php

/*
 * This file is part of Twig.
 *
<<<<<<< HEAD
 * (c) 2009 Fabien Potencier
 * (c) 2009 Armin Ronacher
=======
 * (c) Fabien Potencier
 * (c) Armin Ronacher
>>>>>>> git-aline/master/master
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Tests a condition.
 *
 * <pre>
 * {% if users %}
 *  <ul>
 *    {% for user in users %}
 *      <li>{{ user.username|e }}</li>
 *    {% endfor %}
 *  </ul>
 * {% endif %}
 * </pre>
<<<<<<< HEAD
=======
 *
 * @final
>>>>>>> git-aline/master/master
 */
class Twig_TokenParser_If extends Twig_TokenParser
{
    public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $expr = $this->parser->getExpressionParser()->parseExpression();
        $stream = $this->parser->getStream();
        $stream->expect(Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideIfFork'));
        $tests = array($expr, $body);
        $else = null;

        $end = false;
        while (!$end) {
            switch ($stream->next()->getValue()) {
                case 'else':
                    $stream->expect(Twig_Token::BLOCK_END_TYPE);
                    $else = $this->parser->subparse(array($this, 'decideIfEnd'));
                    break;

                case 'elseif':
                    $expr = $this->parser->getExpressionParser()->parseExpression();
                    $stream->expect(Twig_Token::BLOCK_END_TYPE);
                    $body = $this->parser->subparse(array($this, 'decideIfFork'));
                    $tests[] = $expr;
                    $tests[] = $body;
                    break;

                case 'endif':
                    $end = true;
                    break;

                default:
<<<<<<< HEAD
                    throw new Twig_Error_Syntax(sprintf('Unexpected end of template. Twig was looking for the following tags "else", "elseif", or "endif" to close the "if" block started at line %d).', $lineno), $stream->getCurrent()->getLine(), $stream->getFilename());
=======
                    throw new Twig_Error_Syntax(sprintf('Unexpected end of template. Twig was looking for the following tags "else", "elseif", or "endif" to close the "if" block started at line %d).', $lineno), $stream->getCurrent()->getLine(), $stream->getSourceContext());
>>>>>>> git-aline/master/master
            }
        }

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new Twig_Node_If(new Twig_Node($tests), $else, $lineno, $this->getTag());
    }

    public function decideIfFork(Twig_Token $token)
    {
        return $token->test(array('elseif', 'else', 'endif'));
    }

    public function decideIfEnd(Twig_Token $token)
    {
        return $token->test(array('endif'));
    }

    public function getTag()
    {
        return 'if';
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_TokenParser_If', 'Twig\TokenParser\IfTokenParser', false);
>>>>>>> git-aline/master/master
