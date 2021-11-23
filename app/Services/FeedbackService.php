<?php


namespace App\Services;


use App\Constants\FlashMessages;
use App\Exceptions\Feedbacks\FeedbackNotCreatedException;
use App\Exceptions\Feedbacks\FeedbackNotDeletedException;
use App\Exceptions\Feedbacks\FeedbackNotUpdatedException;
use App\Models\Feedback;
use Throwable;

class FeedbackService
{
    private Feedback $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @param array $validatedFeedbackData
     * @throws Throwable
     */
    public function create(array $validatedFeedbackData): void
    {
        throw_if(!$this->feedback->create($validatedFeedbackData),
            FeedbackNotCreatedException::class,
            FlashMessages::ERROR_CREATE_FEEDBACK
        );
    }

    /**
     * @param array $validatedFeedbackData
     * @param int $feedbackId
     * @throws Throwable
     */
    public function update(array $validatedFeedbackData, int $feedbackId): void
    {
        $feeback = $this->find($feedbackId);

        throw_if(!$feeback->update($validatedFeedbackData),
            FeedbackNotUpdatedException::class,
            FlashMessages::ERROR_UPDATE_FEEDBACK
        );
    }

    /**
     * @param int $feedbackId
     * @return mixed
     */
    public function find(int $feedbackId): Feedback
    {
        return $this->feedback->findOrFail($feedbackId);
    }

    /**
     * @param int $feedbackId
     * @throws Throwable
     */
    public function delete(int $feedbackId): void
    {
        $feedback = $this->find($feedbackId);

        throw_if(!$feedback->delete(),
            FeedbackNotDeletedException::class,
            FlashMessages::ERROR_DELETE_FEEDBACK
        );
    }
}
