<?php

namespace App\Services;

use DomainException;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\MessageConverter;
use Symfony\Component\Mime\Header\HeaderInterface;
use Symfony\Component\Mailer\Transport\AbstractTransport;

class OsPanelMailTransport extends AbstractTransport
{
    /**
     * @var string[]
     */
    protected static array $headers = [
        'MIME-Version' => '1.0',
        'Content-type' => 'text/html; charset=utf-8',
    ];

    /**
     * @noinspection PhpParamsInspection
     */
    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        if (($from = $email->getHeaders()->get('from')) instanceof HeaderInterface) {
            static::$headers['From'] = $from->getBodyAsString();
        }

        if (!mail(
            $email->getHeaders()->get('to')?->getBodyAsString(),
            $email->getSubject(),
            $email->getHtmlBody(),
            static::$headers)
        ) {
            throw new DomainException('Ошибка при отправке почты');
        }
    }

    public function __toString(): string
    {
        return 'ospanel';
    }
}
