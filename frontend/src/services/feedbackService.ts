import api from './api'

export const getStudentExam = () => {
  return api.get('/student/exam')
}

export const submitFeedback = (data: {
  exam_id: number
  problem_types: string[]
  feedback_text: string
}) => {
  return api.post('/feedback', data)
}