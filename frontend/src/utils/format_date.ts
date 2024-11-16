const formatDate = (date: string) => {
  return (new Date(date)).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' })
}

export { formatDate }