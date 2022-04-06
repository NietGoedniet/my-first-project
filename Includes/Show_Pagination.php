    <nav>
        <div class="row marginTop">
            <div>
                <h6 class="text-black ml-2"><?php echo "Current page: <b>".$currentPage . "</b> / ".$lastPage .
                "&nbsp;&nbsp;&nbsp;&nbsp;Total Rows Selected: ". $Sr. " / ". $TotalRows; ?>

                </h6>
            </div>
            <ul class="pagination justify-content-center">
                <?php if($currentPage != $firstPage) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous"><span aria-hidden="true">First</span></a>
                        </li>
                <?php } ?>
                <?php if($currentPage >= 2) { ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage; ?></a></li>
                <?php } ?>
                <li class="page-item active"><a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage; ?></a></li>
                <?php if($currentPage != $lastPage) { ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage; ?></a></li>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next"><span aria-hidden="true">Last</span></a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
