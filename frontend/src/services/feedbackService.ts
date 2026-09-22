import api from './api'

export const getStudentExam = () => {
  return api.get('/student/exam')
}

export const submitFeedback = (data: {
  exam_id: number
  question_number: number
  problems: string[]
  specific_feedback: string
  feedback_date: string
}) => {
  return api.post('/feedback', data)
}