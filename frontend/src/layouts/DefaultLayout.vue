<template>
  <div class="layout">
    <header class="layout-header">
      <div class="layout-header-inner">
        <h1>ASTech Exam Feedback</h1>
      </div>
    </header>

    <main class="layout-main">
      <slot />
    </main>

    <footer class="layout-footer">
      <p>Exam Feedback System</p>
    </footer>
  </div>
</template>

<style scoped>
.layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f4f6f8;
}

.layout-header {
  background-color: #ffffff;
  border-bottom: 1px solid #e2e8f0;
  padding: 1.25rem 2rem;
}

.layout-header-inner {
  max-width: 1200px;
  margin: 0 auto;
}

.layout-header h1 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0;
}

.layout-main {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1rem;
}

.layout-footer {
  background-color: #ffffff;
  border-top: 1px solid #e2e8f0;
  padding: 1.25rem 2rem;
  text-align: center;
}

.layout-footer p {
  font-size: 0.9rem;
  color: #718096;
  margin: 0;
}
</style>