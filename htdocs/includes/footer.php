  </main>

  <footer class="footer">
    © PureBite Beauty — made with care in California.
  </footer>

  <!-- Carousel Script -->
  <script>
  const track = document.querySelector('.carousel-track');
  if(track){
    const slides = Array.from(track.children);
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');

    let currentIndex = 0;

    function updateSlide(position) {
      track.style.transform = `translateX(-${position * 100}%)`;
    }

    if(nextBtn){
      nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlide(currentIndex);
      });
    }

    if(prevBtn){
      prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlide(currentIndex);
      });
    }

    setInterval(() => {
      currentIndex = (currentIndex + 1) % slides.length;
      updateSlide(currentIndex);
    }, 6000);
  }
  </script>
</body>
</html>
