        <?php $rs = gestorItem::get_item_proceso($_REQUEST['p']) ?>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title">
                            <?php $row1 = gestorProceso::set_proceso($_REQUEST['p']) ?>
                            PROCESO <?php sistema::imprimir($row1[0]) ?> - <?php sistema::imprimir($row1[1]) ?>
                        </h3>
                    </div>

                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">

                <!--begin::Section 3-->
                    <div class="m-tabs-content__item" id="m_section">

                        <div class="m-accordion m-accordion--bordered" id="m_section_content">
                           <?php $i = 0;  ?>
                           <?php foreach ($rs as $row1) { ?>
                           <?php $i++; ?>
                                <!--begin::Item-->
                                <div class="m-accordion__item">
                                    <div class="m-accordion__item-head" role="tab" id="m_section_content_<?php sistema::imprimir($row1[0]) ?>" data-toggle="collapse" href="#m_section_<?php sistema::imprimir($row1[0]) ?>" >
                                        <span class="m-accordion__item-icon"><i class=" flaticon-book"></i></span>
                                        <span class="m-accordion__item-title"><?php sistema::imprimir($row1[2]) ?></span>

                                        <span class="m-accordion__item-mode"></span>
                                    </div>
                                    <div class="m-accordion__item-body collapse <?php if($i == 1) sistema::imprimir('show') ?>" id="m_section_<?php sistema::imprimir($row1[0]) ?>" role="tabpanel" aria-labelledby="m_section_content_<?php sistema::imprimir($row1[0]) ?>" data-parent="#m_section_content">
                                        <div class="m-accordion__item-content">
                                            <div class="m-scrollable" data-scrollable="true" data-max-height="200">
                                            <p>
                                               <?php sistema::imprimir($row1[3]) ?>

                                            </p>
                                            <!-- <p>
                                                Lorem Ipsum has been the industry's <a href="#" class="m-link m--font-boldest">Example boldest link</a>
                                            </p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Item-->
                         <?php } ?>
                    </div>
                    <!--begin::Section 3-->

            </div>
        </div>
    </div>
<!-- end::Body -->