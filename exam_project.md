┌─────────────┐
│   rounds    │
├─────────────┤
│ id          │
│ code        │
│ name        │
│ status      │
└──────┬──────┘
       │
       │ 1:N
       ▼
┌────────────────┐
│    batches     │
├────────────────┤
│ id             │
│ round_id       │◄──────── rounds
│ tsp_id         │◄──────── tsps
│ shift_id       │◄──────── shifts
│ subject_id     │◄──────── subjects
│ batch_number   │
│ batch_code     │
│ capacity       │
│ status         │
└───────┬────────┘
        │
        │ 1:N
        ▼
┌─────────────────┐
│   exam_sets     │
├─────────────────┤
│ id              │
│ batch_id        │
│ name            │
│ status          │
└────────┬────────┘
         │
         │ 1:N
         ▼
┌─────────────────┐
│      exams      │
├─────────────────┤
│ id              │
│ exam_set_id     │
│ exam_type       │
│ component       │
│ mode            │
│ status          │
│ duration        │
│ max_marks       │
│ pass_marks      │
│ start_at        │
│ end_at          │
└───────┬─────────┘
        │
        ├──────────────────────┐
        │                      │
        ▼                      ▼
┌─────────────────┐    ┌─────────────────┐
│ exam_questions  │    │ exam_topic_     │
│                 │    │ quotas          │
├─────────────────┤    ├─────────────────┤
│ exam_id         │    │ exam_id         │
│ question_id     │    │ topic_id        │
│ question_order  │    │ question_count  │
└────────┬────────┘    └─────────────────┘
         │
         ▼
┌─────────────────┐
│    questions    │
├─────────────────┤
│ id              │
│ subject_id      │
│ chapter_id      │
│ topic_id        │
│ question        │
│ marks           │
│ difficulty      │
│ status          │
└────────┬────────┘
         │
         │ 1:N
         ▼
┌─────────────────┐
│ question_options│
├─────────────────┤
│ id              │
│ question_id     │
│ option_text     │
│ is_correct      │
│ option_order    │
└─────────────────┘


┌──────────────┐
│   students   │
├──────────────┤
│ id           │
│ student_id   │
│ name         │
│ email        │
│ password     │
└───────┬──────┘
        │
        │ N:M
        ▼
┌──────────────────┐
│  batch_students  │
├──────────────────┤
│ batch_id         │
│ student_id       │
│ assigned_at      │
└──────────────────┘




students
    │
    │ 1:N
    ▼
┌────────────────────────┐
│ student_exam_attempts  │
├────────────────────────┤
│ id                     │
│ student_id             │
│ exam_id                │
│ exam_set_id            │
│ session_token          │
│ started_at             │
│ expires_at              │
│ submitted_at           │
│ status                 │
│ score                  │
│ violation_count        │
└───────────┬────────────┘
            │
            │ 1:N
            ▼
┌────────────────────────┐
│ exam_attempt_questions │
├────────────────────────┤
│ attempt_id             │
│ question_id            │
│ question_snapshot      │
│ question_order         │
│ marks                  │
└───────────┬────────────┘
            │
            │ 1:N
            ▼
┌────────────────────────┐
│      exam_answers      │
├────────────────────────┤
│ attempt_id             │
│ question_id            │
│ answer                 │
│ saved_at               │
└────────────────────────┘

DRAFT
  │
  ▼
SCHEDULED
  │
  ▼
READY
  │
  ▼
STARTED
  │
  ▼
ENDED
  │
  ▼
PROCESSING
  │
  ▼
COMPLETED