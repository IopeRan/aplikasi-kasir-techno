                    <?php if( $page > 1 ) : ?>
                    <a href="?page=<?= $page - 1; ?>">&lt;</a>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $countPage; $i++) : ?>
                      <?php if($i == $page) : ?>
                        <a style="color: #222; font-weight: bold;" href="?page=<?= $i; ?>"><?= $i; ?></a>
                      <?php else : ?>
                        <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                      <?php endif; ?>
                    <?php endfor; ?>

                    <?php if( $page < $countPage ) : ?>
                    <a href="?page=<?= $page + 1; ?>">&gt;</a>
                    <?php endif; ?>